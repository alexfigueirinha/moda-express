<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserEdit extends Component
{
    public $userId;
    public $name;
    public $email;
    public $password;

    public function mount($id)
    {
        $this->userId = $id;
        $user = User::find($this->id);
        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
        }
    }

    public function update()
    {

        $user = User::find($this->id);

        if ($this->password != null) {
            $user->password = Hash::make($this->password);
        }

        $user->name = $this->name;
        $user->email = $this->email;

        $user->save();

        session()->flash('sucess','Atualizado');
    }

    public function render()
    {
        return view('livewire.user.user-edit');
    }
}
