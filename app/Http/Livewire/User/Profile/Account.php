<?php

namespace App\Http\Livewire\User\Profile;

use Livewire\Component;

class Account extends Component
{
    public function render()
    {
        return view('livewire.user.profile.account')->extends('user.layouts.user_one');
    }
}
