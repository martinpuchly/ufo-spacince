<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();
        return view('admin.users.index', compact('users'));
    }


    public function delete(User $user)
    {
        $user->delete();
        return back()->with('info', 'Užívateľ ' . $user->name . ' bol vymazaný.');
    }
}
