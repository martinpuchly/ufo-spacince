@extends('layouts.app')

@section('content')

<h1>Upraviť tím: {{ $team->name }}</h1>

<div class="col-6">
    <div class="float-lef">
        <a href="{{ route('admin.teams') }}" title="späť">
            <<< Späť </a>
    </div>
    <form action="{{ route('admin.team.edit', ['team'=>$team->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('admin.teams._form', ['team'=>$team])
    </form>
</div>
</div>
@endsection