<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UsersController extends Controller
{
    private UserService $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function getUsersPage()
    {
        $users = $this->userService->findAll();
        return view('users', [
            'users' => $users,
        ]);
    }
    
    public function changeRole(Request $request, $id)
    {
        $admin = $request->input('admin') === 'true' ? true : false;
        $this->userService->changeRole($id, $admin);
        return redirect('/users');
    }
}
