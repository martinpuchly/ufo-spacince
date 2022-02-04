@extends('layouts.app')
@section('title', 'upraviť hráčsky profil')
@section('content')
<h1>Upraviť profil hráča: {{ $player->fullName }}</h1>
<form action="{{ route('player.edit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    @include('players._edit_form')
    <div class="row mt-3">
        <div class="col-12 pl-5">
            <button class="btn btn-primary"> Upraviť profil hráča </button>
        </div>
    </div>
</form>
<div class="float-end">
    <form action="{{ route('player.delete') }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="if(!confirm('Naozaj chcete vymazať svoj hráčsky profil?')) return false">Vymazať hráčky účet</button>
    </form>
</div>



@endsection