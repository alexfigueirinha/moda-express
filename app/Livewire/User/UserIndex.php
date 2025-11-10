<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserIndex extends Component
{
    public $search = '';

    public function render()
    {
        $users = User::where('name', 'like','%'.$this->search.'%')->get();
        return view('livewire.user.user-index', compact('users'));
    }

    function delete($userID){
        $user = User::find($userID);
        if ($user){
            $user->delete();
            session()->flash('success','Excluído');
        }       
    }
}
