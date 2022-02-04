@extends('layouts.app')
@section('title', 'upraviť hráčsky profil')
@section('content')
<div class="float-left">
    <a href="{{ route('admin.players') }}" title="späť">
        <<< späť hráči</a>
</div>
<h1>Upraviť profil hráča: {{ $player->fullName }}</h1>

<form action="{{ route('admin.player.edit', ['player'=>$player->slug]) }}" method="POST">
    @csrf
    @method('PATCH')
    @include('players._edit_form')
    <!--- ADMIN -->
    <div class="row mt-5">
        <hr>
        <h2>Administrácia:</h2>
        <div class="col-4 form-group">
            <label for="team_id" class="label-larger">Tím:</label>
            <select name="team_id" id="team_id" class="form-select">
                <option value=""> --- tím ---</option>
                @foreach($teams as $team)
                <option value="{{ $team->id }}" {{ $team->id == $player->team_id ? 'selected' : '' }}>{{ $team->name }}</option>
                @endforeach
            </select>
            @if($errors->has('team_id'))
            <div class="error_msg">{{ $errors->get('team_id')[0] }}</div>
            @endif
        </div>
        <div class="col-4 form-group">
            <label class="label-larger">Hráčsky účet:</label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="status" {{ $player->status == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="flexSwitchCheckDefault">aktívny účet hráča</label>
            </div>


        </div>
        <!--- ADMIN END -->
        <div class="row mt-3">
            <div class="col-12 pl-5">
                <button class="btn btn-primary"> Upraviť profil hráča </button>
            </div>
        </div>
    </div>
</form>
<div class="float-end">
    <form action="{{ route('admin.player.delete', ['player'=>$player->slug]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="if(!confirm('Naozaj chcete vymazať svoj hráčsky profil?')) return false">Vymazať hráčky účet</button>
    </form>
</div>


@endsection