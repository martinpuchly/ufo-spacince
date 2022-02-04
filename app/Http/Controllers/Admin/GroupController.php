<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Group;
use App\User;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{

    public function index()
    {
        $group = new Group;
        $groups = Group::all();
        return view('admin.groups.index', compact('groups', 'group'));
    }

    public function store(Request $request)
    {
        if (!$validator = $this->validateGroup($request)) return redirect()->route('admin.groups')->withErrors($validator)->withInput();
        $group = new Group($request->all());
        $group->save();
        return redirect()->route('admin.groups')->with('succeed', 'Skupina bola pridaná.');
    }


    public function edit(Group $group)
    {
        return view('admin.groups.edit', compact('group'));
    }

    public function update(Request $request, Group $group)
    {
        if (!$validator = $this->validateGroup($request, $group_id = $group->id)) return back()->withErrors($validator)->withInput();
        $group->fill($request->all());
        $group->save();
        return back()->with('succeed', 'Skupina bola upravená.');
    }

    public function delete(Group $group)
    {
        $group->delete();
        return redirect()->route('admin.groups')->with('info', 'Skupina bola vymazaná.');
    }



    public function validateGroup($request, $group_id = "")
    {
        return $request->validate(
            [
                'name' => 'required|min:3|max:255|unique:groups,name,' . $group_id . ',id',
                'description' => 'nullable|max:250',
            ],
            [
                'name.required' => 'Názov skupiny je povinný.',
                'name.unique' => 'Názov skupiny sa už v databáze nachádza.',
                'name.min' => 'Názov skupiny musí obshaovať minimálne :min znakov.',
                'name.max' => 'Názov skupiny môže obsahovať maximálne :max znakov.',
                'description.max' => 'Popis skupiny môže obsahovať maximálne :max znakov.',
            ]
        );
    }

    public function user(User $user)
    {
        $groups = Group::orderBy('name')->get();
        $user_groups = $user->groups->pluck('id');
        return view('admin.groups.user', compact('user', 'groups', 'user_groups'));
    }
    public function userUpdate(Request $request, User $user)
    {
        DB::table('group_user')->where('user_id', $user->id)->delete();
        if ($request->input('user_groups')) {
            foreach ($request->input('user_groups') as $group) {
                DB::table('group_user')->insert([
                    'user_id' => $user->id,
                    'group_id' => $group
                ]);
            }
        }

        return back()->with('succeed', 'Skupiny užívateľa ' . $user->name . ' boli uložené.');
    }
}
