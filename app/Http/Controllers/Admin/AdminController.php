<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Permission;

class AdminController extends Controller
{
    public function index()

    {
        $permissions = Permission::orderedPerm();
        return view('admin.index', compact('permissions'));
    }
}
