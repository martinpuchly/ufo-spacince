@extends('layouts.app')

@section('content')
@if($user->id === auth()->id())
<h1>Požiadať o vytvorenie hráčskeho konta</h1>
@else
<h1>Vytvoriť hráča: {{ is_int($user->id) ? $user->name : '' }}</h1>
@endif
@if($errors->has('user_id'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ $errors->get('user_id')[0] }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row col-8">
    <form action="{{ route('player.add') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-4 form-group">

                <label for="first_name" class="label-larger">Meno:</label>

                <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name', $player->first_name) }}">
                @if($errors->has('first_name'))
                <div class="error_msg">{{ $errors->get('first_name')[0] }}</div>
                @endif
            </div>
            <div class="col-4 form-group">
                <label for="last_name" class="label-larger">Priezvisko:</label>
                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name', $player->last_name) }}">
                @if($errors->has('last_name'))
                <div class="error_msg">{{ $errors->get('last_name')[0] }}</div>
                @endif
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 pl-5">
                <button class="btn btn-primary"> Požiadať o vytvorenie hráčskeho konta </button>
            </div>
        </div>
    </form>
</div>




@endsection