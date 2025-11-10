<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserCreate extends Component
{
    public $name;
    public $email;
    public $password;

    protected $rules =['name' => 'required'];

    protected $messages = ['name.required'=> 'Prencher Nome'];

    public function render()
    {
        return view('livewire.user.user-create');
    }

    function store(){
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        session()->flash(['sucess', 'Usuários Cadastrado com sucesso']);
    }
}
