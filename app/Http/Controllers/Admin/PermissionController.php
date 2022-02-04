<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Permission;
use App\User;
use App\Group;


class PermissionController extends Controller
{
    public function index()
    {
        $permission = new Permission;
        $permissions = Permission::orderBy('main_name', 'ASC')->get();
        return view('admin.permissions.index', compact('permission', 'permissions'));
    }

    public function store(Request $request)
    {
        if (!$validator = $this->validatePersmission($request)) return redirect()->route('admin.permissions')->withErrors($validator)->withInput();
        $permission = new Permission($request->all());
        $permission->link_in_admin_menu = $permission->link_in_admin_menu == "on" ? 1 : 0;
        $permission->save();
        return redirect()->route('admin.permissions')->with('succeed', 'Povolenie bolo pridané.');
    }


    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        if (!$validator = $this->validatePersmission($request, $id = $permission->id)) return back()->withErrors($validator)->withInput();
        $permission->fill($request->all());
        $permission->link_in_admin_menu = $permission->link_in_admin_menu == "on" ? 1 : 0;
        $permission->save();
        return back()->with('succeed', 'Povolenie bolo upravené.');
    }

    public function delete(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('admin.permissions')->with('info', 'Povolenie bolo vymazané.');
    }

    public function validatePersmission($request, $id = "")
    {
        return $request->validate(
            [
                'name' => 'required|min:3|max:255|unique:permissions,name,' . $id . ',id',
                'main_name' => 'required|min:3|max:255',
                'key' => 'required|min:3|max:255|unique:permissions,name,' . $id . ',id',
                'route' => 'required|min:3|max:255|unique:permissions,name,' . $id . ',id'
            ],
            [
                'name.required' => 'Názov povolenia je povinný.',
                'name.unique' => 'Názov povolenia sa už v databáze nachádza.',
                'name.min' => 'Názov povolenia musí obshaovať minimálne :min znakov.',
                'name.max' => 'Názov povolenia môže obsahovať maximálne :max znakov.',
                'main_name.required' => 'Názov nadradenej šasti povolenia je povinný.',
                'main_name.min' => 'Názov nadradenej šasti povolenia musí obshaovať minimálne :min znakov.',
                'main_name.max' => 'Názov nadradenej šasti povolenia môže obsahovať maximálne :max znakov.',
                'key.required' => 'Kľúč je povinný.',
                'key.unique' => 'Kľúč sa už v databáze nachádza.',
                'key.min' => 'Kľúč musí obshaovať minimálne :min znakov.',
                'key.max' => 'Kľúč môže obsahovať maximálne :max znakov.',
                'route.required' => 'Route je povinný.',
                'route.unique' => 'Route sa už v databáze nachádza.',
                'route.min' => 'Route musí obshaovať minimálne :min znakov.',
                'route.max' => 'Route môže obsahovať maximálne :max znakov.',
            ]
        );
    }



    public function user(User $user)
    {
        $permissions = Permission::orderedPerm();
        $user_permissions = $user->permissions->pluck('id');
        return view('admin.permissions.user', compact('user', 'permissions', 'user_permissions'));
    }

    public function userUpdate(Request $request, User $user)
    {
        DB::table('permission_user')->where('user_id', $user->id)->delete();
        if ($request->input('save_permissions')) {
            foreach ($request->input('save_permissions') as $permission) {
                DB::table('permission_user')->insert([
                    'user_id' => $user->id,
                    'permission_id' => $permission
                ]);
            }
        }

        return back()->with('succeed', 'Povolenia užívateľa ' . $user->name . ' boli uložené.');
    }

    public function group(Group $group)
    {
        $permissions = Permission::orderedPerm();
        $group_permissions = $group->permissions->pluck('id');
        return view('admin.permissions.group', compact('group', 'permissions', 'group_permissions'));
    }

    public function groupUpdate(Request $request, Group $group)
    {
        DB::table('group_permission')->where('group_id', $group->id)->delete();
        if ($request->input('save_permissions')) {
            foreach ($request->input('save_permissions') as $permission) {
                DB::table('group_permission')->insert([
                    'group_id' => $group->id,
                    'permission_id' => $permission
                ]);
            }
        }
        return back()->with('succeed', 'Povolenia skupiny ' . $group->name . ' boli uložené.');
    }
}
