<?php

namespace App\Http\Livewire\User\Profile;

use Livewire\Component;
use App\Models\User;
use Auth;

class LoginAndSecurity extends Component
{
    public $name = "";

    public function editProfile()
    {
        if ($this->name) {
            $validate = $this->validate([
                'name' => 'required|min:3',
            ]);
            $user = User::find(Auth::user()->id);
            $user->update($validate);
        }
    }
    public function render()
    {
        return view('livewire.user.profile.login-and-security')->extends('user.layouts.user_one');
    }
}
