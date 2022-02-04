@extends('layouts.app')

@section('content')

<h1>Upraviť povolenie: {{ $permission->name }}</h1>

<div class="col-6">
    <div class="float-lef">
        <a href="{{ route('admin.permissions') }}" title="späť">
            <<< Späť </a>
    </div>
    <form action="{{ route('admin.permission.edit', ['permission'=>$permission->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('admin.permissions._form', ['permission'=>$permission])
    </form>
</div>
</div>
@endsection