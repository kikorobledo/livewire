<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{

    public $name = '';
    public $email = '';
    public $password = '';
    public $confirmpassword = '';

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|same:confirmpassword'
    ];

    public function updatedEmail(){
        $this->validate(['email' => 'unique:users']);
    }

    public function register(){

        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        auth()->login($user);

        return redirect('/');

    }

    public function render()
    {
        return view('livewire.auth.register')->layout('layouts.auth');;
    }
}
