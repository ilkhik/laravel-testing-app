<?php

namespace App\Services;

use App\Models\User;
use App\ToClient\UserToClient;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function findAll()
    {
        $users = User::all();
        $usersToClient = [];
        foreach ($users as $user) {
            $usersToClient[] = new UserToClient($user);
        }
        return $usersToClient;
    }
    
    public function changeRole($id, $admin)
    {
        $user = User::find($id);
        if ($admin) {
            $user->role = 'ADMIN';
        } else {
            $user->role = 'USER';
        }
        $user->save();
    }
    
    public function changePassword($userId, $oldPassword, $newPassword)
    {
        $user = User::find($userId);
        if (!Hash::check($oldPassword, $user->password)) {
            throw new PasswordIsWrongException();
        }
        $user->password = Hash::make($newPassword);
        $user->save();
    }
}
