<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Team;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        $team = new Team;
        return view('admin.teams.index', compact('teams', 'team'));
    }

    public function store(Request $request)
    {
        if (!$validator = $this->validateTeam($request)) return redirect()->route('admin.teams')->withErrors($validator)->withInput();
        $team = new Team($request->all());
        $team->save();
        return redirect()->route('admin.teams')->with('succeed', 'Tím bol pridaný.');
    }

    public function edit(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        if (!$validator = $this->validateTeam($request, $id = $team->id)) return back()->withErrors($validator)->withInput();
        $team->fill($request->all());
        $team->save();
        return back()->with('succeed', 'Tím bol upravený.');
    }

    public function delete(Team $team)
    {
        $team->delete();
        return redirect()->route('admin.teams')->with('info', 'Tím bol vymazaný.');
    }

    public function validateTeam($request, $id = "")
    {
        return $request->validate(
            [
                'name' => 'required|min:3|max:50|unique:teams,name,' . $id . ',id',
                'min_age' => 'nullable|integer|min:0|max:999',
                'max_age' => 'nullable|integer|min:0|max:999',
            ],
            [
                'name.required' => 'Názov tímu je povinný.',
                'name.unique' => 'Názov tímu sa už v databáze nachádza.',
                'name.min' => 'Názov tímu musí obshaovať minimálne :min znakov.',
                'name.max' => 'Názov tímu môže obsahovať maximálne :max znakov.',
                'min_age.integer' => 'Minimálny vek musí byť celé číslo.',
                'min_age.min' => 'Minimálny vek musí byť minimálne :min.',
                'min_age.max' => 'Minimálny vek môže byť maximálne :max.',
                'max_age.integer' => 'Maximálny vek musí byť celé číslo.',
                'max_age.min' => 'Maximálny vek musí byť minimálne :min.',
                'max_age.max' => 'Maximálny vek môže byť maximálne :max.',

            ]
        );
    }
}
