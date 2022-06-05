<?php

namespace App\Services;

use App\Forms\UserForm;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SignUpService
{
    public function signUp(UserForm $userForm)
    {
        $user = new User();
        $user->login = $userForm->login;
        $user->password = Hash::make($userForm->password);
        $user->role = 'USER';
        $user->signup_date = date('Y-m-d');
        
        $user->save();
    }
}
