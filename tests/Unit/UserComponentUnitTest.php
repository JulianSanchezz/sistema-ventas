<?php

use App\Livewire\User\UserComponent;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class UserComponentUnitTest extends TestCase
{
    public function test_clean_method_resets_properties()
    {
        $component = Livewire::test(UserComponent::class);

        //inicializamos las variables 
        $component->set('name', 'Test User');
        $component->set('email', 'test@example.com');
        $component->set('password', 'password');
        $component->set('admin', false);

        //llamamos al metodo clean
        $component->call('clean');

        
        $this->assertNull($component->get('name'));
        $this->assertNull($component->get('email'));
        $this->assertNull($component->get('password'));
        $this->assertTrue($component->get('admin')); // valor por default
        $this->assertTrue($component->get('active')); // valor por default
    }

    public function test_password_is_hashed_correctly()
    {
        $password = 'plainpassword';
        $hashedPassword = Hash::make($password);

        $this->assertTrue(Hash::check($password, $hashedPassword), 'Password was not hashed correctly');
    }

    public function test_validate_user_data()
    {
        $component = Livewire::test(UserComponent::class);

        // primero probamos ingresar datos correctos 
        $component->set('name', 'Valid User');
        $component->set('email', 'validuser'. time() . '@example.com');
        $component->set('password', 'password123');
        $component->set('re_password', 'password123');

        // validamos
        $component->call('store')
            ->assertHasNoErrors();

        // simula el ingreso de una contraseña incorrecta/diferente
        $component->set('re_password', 'different_password');

        // error de validacion
        $component->call('store')
            ->assertHasErrors(['re_password' => 'same']);
    }

    public function test_email_validation()
    {
        $component = Livewire::test(UserComponent::class);

        // ingreso un mail invalido
        $component->set('email', 'not-an-email');

        //  verifica que falle la validación
        $component->call('store')
            ->assertHasErrors(['email' => 'email']);
    }
}