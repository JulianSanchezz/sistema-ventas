<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //creacion de atributo 
    protected function activeLabel() : Attribute
    {
        return Attribute::make(
            get: function(){
                return $this->attributes['active'] ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-warning">Inactivo</span>'; 
            }
        );
    }  


    protected function imagen() : Attribute
    {
        return Attribute::make(
            get: function(){
                return $this->image ? Storage::url('public/'.$this->image->url) : asset('no-image.png'); 
            }
        );
    }

    //metodo image usamos relacion poliformica 1a1, le pasamos el model de image, primer parametro ruta segundo paramtro la funcion damos la posibilidad de tener imagen debe tener este metodo
    public function image(){
        return $this->morphOne('App\Models\Image','imageable');

    }

}
