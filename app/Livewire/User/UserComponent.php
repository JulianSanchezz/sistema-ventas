<?php

namespace App\Livewire\User;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;


#[Title('Usuarios')]
class UserComponent extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $search='';
    public $totalRegistros=0;
    public $cant=5;

     // Propiedades model
     public $Id;
     public $name;
     public $email;
     public $password;
     public $admin = true;
     public $active = true;
     public $image;
     public $imageModel;
     public $re_password;

    public function render()
    {

        $this->totalRegistros = User::count();

        $users = User::where('name','like','%'.$this->search.'%')
            ->orderBy('id','desc')
            ->paginate($this->cant);

        return view('livewire.user.user-component',[
            'users'=>$users
        ]);
    }

    public function create(){

        $this->Id=0;

        $this->clean();

        $this->dispatch('open-modal','modalUser');
    }

    public function store(){

        $rules = [
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:5',
            're_password' => 'required|same:password',
            'image' => 'image|max:1024|nullable'

        ];


        $this->validate($rules);

        $user = new User();
     
         $user->name = $this->name;
         $user->email = $this->email; 
         $user->password = bcrypt($this->password);
         $user->admin = $this->admin;
         $user->active = $this->active;
         $user->save();

        if($this->image){
            $customName = 'users/'.uniqid().'.'.$this->image->extension();
            $this->image->storeAs('public',$customName);
            $user->image()->create(['url'=>$customName]);
            //guardamos y asociamos la img con el usuario
        }

        $this->dispatch('close-modal','modalUser');
        $this->dispatch('msg','Usuario creado correctamente.');
        $this->clean();
        
    }

    public function edit(User $user){
      
        $this->clean();

        $this->Id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->admin = $user->admin ? true : false;
        $this->active = $user->active ? true : false;
        $this->imageModel = $user->image ? $user->image->url : null;

        $this->dispatch('open-modal','modalUser');

    }

    public function update(User $user){
        // dump($category);
        $rules = [
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|max:255|unique:users,id,'.$this->Id,
            'password' => 'min:5|nullable',
            're_password' => 'same:password',
            'image' => 'image|max:1024|nullable'
        ];


        $this->validate($rules);

        $user->name = $this->name;
        $user->email = $this->email;
        $user->admin = $this->admin;
        $user->active = $this->active;

         // Solo cambiar la contraseña si está presente
        if($this->password){
            // Cifrar la contraseña antes de guardarla
            $user->password = bcrypt($this->password);
        }

        $user->update();

        if($this->image){

            if($user->image!=null){
                Storage::delete('public/'.$user->image->url);
                $user->image()->delete();
            }

            $customName = 'users/'.uniqid().'.'.$this->image->extension();
            $this->image->storeAs('public',$customName);
            $user->image()->create(['url'=>$customName]);
        }

        $this->dispatch('close-modal','modalUser');
        $this->dispatch('msg','Usuario editado correctamente.');

        $this->clean();

    }

    #[On('destroyUser')]
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() == $user->id) {
            $this->dispatch('msg', 'No puedes desactivar tu propio usuario.', 'warning');
            return;
        }

        $user->active = false;
        $user->save();

        $this->dispatch('msg', 'Usuario desactivado correctamente.');
    }

    
    // Metodo encargado de la limpieza
    public function clean(){
        $this->reset(['Id','name','email','password','admin','active','image','imageModel']);
        $this->resetErrorBag();
    }


}
