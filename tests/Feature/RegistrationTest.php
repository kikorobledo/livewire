<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    function registration_page_contains_livewire_component(){

        $this->get('/register')->assertSeeLivewire('auth.register');

    }

    /** @test **/
    function can_register(){

        Livewire::test('auth.register')
            ->set('name', 'kiko')
            ->set('email', 'kiko@kiko.com')
            ->set('password', '123456')
            ->set('confirmpassword', '123456')
            ->call('register')
            ->assertRedirect('/');

        $this->assertTrue(User::whereEmail('kiko@kiko.com')->exists());

        $this->assertEquals('kiko@kiko.com', auth()->user()->email );

    }

    /** @test **/
    function email_is_required(){

        Livewire::test('auth.register')
            ->set('name', 'kiko')
            ->set('email', '')
            ->set('password', '123456')
            ->set('confirmpassword', '123456')
            ->call('register')
            ->assertHasErrors(['email' => 'required']);

    }

    /** @test **/
    function email_is_valid(){

        Livewire::test('auth.register')
            ->set('name', 'kiko')
            ->set('email', 'asdf')
            ->set('password', '123456')
            ->set('confirmpassword', '123456')
            ->call('register')
            ->assertHasErrors(['email' => 'email']);

    }

    /** @test **/
    function email_hasnt_been_taken_already(){

        User::create([
            'name' => 'kiko',
            'email' => 'kiko@kiko.com',
            'password' => '123456'
        ]);

        Livewire::test('auth.register')
            ->set('name', 'kiko')
            ->set('email', 'kiko@kiko.com')
            ->set('password', '123456')
            ->set('confirmpassword', '123456')
            ->call('register')
            ->assertHasErrors(['email' => 'unique']);

    }

    /** @test **/
    function see_email_hasnt_already_been_taken_validation_message_as_user_types(){

        User::create([
            'name' => 'kiko',
            'email' => 'kiko@kiko.com',
            'password' => '123456'
        ]);

        Livewire::test('auth.register')
            ->set('email', 'kik@kiko.com')
            ->assertHasNoErrors()
            ->set('email', 'kiko@kiko.com')
            ->assertHasErrors(['email' => 'unique']);

    }

    /** @test **/
    function password_is_required(){

        Livewire::test('auth.register')
            ->set('name', 'kiko')
            ->set('email', 'kiko@kiko.com')
            ->set('password', '')
            ->set('confirmpassword', '123456')
            ->call('register')
            ->assertHasErrors(['password' => 'required']);

    }

    /** @test **/
    function password_is_min_6_characters(){

        Livewire::test('auth.register')
            ->set('name', 'kiko')
            ->set('email', 'kiko@kiko.com')
            ->set('password', '12345')
            ->set('confirmpassword', '123456')
            ->call('register')
            ->assertHasErrors(['password' => 'min']);

    }

    /** @test **/
    function password_match(){

        Livewire::test('auth.register')
            ->set('name', 'kiko')
            ->set('email', 'kiko@kiko.com')
            ->set('password', '123456')
            ->set('confirmpassword', '123s456')
            ->call('register')
            ->assertHasErrors(['password' => 'same']);

    }

}
