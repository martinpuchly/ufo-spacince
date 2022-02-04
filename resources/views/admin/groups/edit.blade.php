@extends('layouts.app')

@section('content')

<h1>Upraviť skupinu: {{ $group->name }}</h1>

<div class="col-6">
    <div class="float-start">
        <a href="{{ route('admin.groups') }}" title="späť">
            <<< Späť </a>
    </div>
    <h2>Upraviť skupinu: {{ $group->name }}</h2>
    <form action="{{ route('admin.group.edit', ['group'=>$group->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('admin.groups._form', ['group'=>$group])
    </form>
</div>
</div>




@endsection