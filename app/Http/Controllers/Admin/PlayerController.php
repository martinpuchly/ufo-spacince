<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Player;
use Illuminate\Http\Request;
use App\User;
use App\Team;
use Illuminate\Support\Str;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::orderby('last_name')->get();
        return view('admin.players.index', compact('players'));
    }


    public function create(User $user)
    {
        $player = new Player();
        $teams = Team::all();
        return view('admin.players.create', compact('user', 'player', 'teams'));
    }

    public function store(PlayerRequest $request, User $user)
    {
        $player = new Player($request->all());
        $player->status = 1;
        $player->save();
        return redirect()->route('admin.users')->with('succeed', 'Hráčsky profil užívateľa ' . $user->name . ' bol vytovrený.');
    }

    public function edit(Player $player)
    {
        $teams = Team::all();
        return view('admin.players.edit', compact('player', 'teams'));
    }

    public function update(PlayerRequest $request, Player $player)
    {
        $player->fill($request->all());
        $player->status = $request->status == "on" ? 1 : 0;
        // UPLOAD PLAYER PHOTO
        if ($request->file('photo') && $request->file('photo')->isValid()) {
            $fileName = Str::random(40) . '.' . $player->photo->extension(); // MENO + KONCOVKA OBRAZKU        
            $image = Image::make($player->photo);
            $image->resize(350, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $player->photo  = $request->file('photo')->storeAs(
                'storage/players',
                $fileName,
                'public'
            );
        }

        $player->save();
        return redirect()->route('admin.player.edit', ['player' => $player->slug])->with('succeed', 'Hráčsky profil bol upravený.');
    }

    public function delete(Player $player)
    {
        $player->delete();
        return redirect()->route('admin.players', ['player' => $player->slug])->with('succeed', 'Hráčsky profil bol vymazaný.');
    }
}
