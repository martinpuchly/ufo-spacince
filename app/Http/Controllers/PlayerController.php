<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Player;
use App\Team;
use App\Http\Requests\PlayerRequest;
use Illuminate\Support\Str;
use Image;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{


    public function index()
    {
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->player != null && $user->player->status == 0) return redirect('/')->with('info', 'Čaká sa na schválenie hráčskeho účtu.');
        if ($user->player != null && $user->player->status == 1) return  redirect()->route('player.edit', ['player' => $user->player->slug]);

        $player = new Player();
        return view('players.create', compact('player', 'user'));
    }

    public function store(PlayerRequest $request)
    {
        $player = new Player($request->all());
        $player->status = $request->user()->hasPermission('player-create') ? 1 : 0;
        $player->save();
        if ($player->status == 1) {
            return redirect()->route('player.edit')->with('succeed', "Hráčske konto bolo vytvorené.");
        }
        return redirect('/')->with('succeed', "Požiadavka na hráčske konto bola odoslaná. Čakajte sa na schválenie.");
    }

    public function edit()
    {
        if (!auth()->user()->is_player) {
            return redirect()->route('player.add')->with('info', 'Zatiaľ nemáte aktívny hráčsky účet. Skúste o neho požiadať.');
        }
        $player = auth()->user()->player;
        return view('players.edit', compact('player'));
    }

    public function update(PlayerRequest $request)
    {
        $player = auth()->user()->player;
        $player->fill($request->all());
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
        return redirect()->route('player.edit')->with('succeed', 'Hráčsky profil bol upravený.');
    }


    public function delete()
    {
        Player::where('user_id', auth()->user()->id)->delete();
        return redirect('/')->with('succeed', 'Váš hráčsky účet bol vymazaný.');
    }
}
