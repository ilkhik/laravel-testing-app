<?php

namespace App\ToClient;

use App\Models\User;

class UserToClient
{
    public $id;
    public $login;
    public $role;
    public $signupDate;
    
    public function __construct(User $user)
    {
        $this->id = $user->id;
        $this->login = $user->login;
        $this->role = $user->role;
        $this->signupDate = $user->signup_date;
    }
}
