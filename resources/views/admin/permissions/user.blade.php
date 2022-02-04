@extends('layouts.app')

@section('content')
<div class="float-lef">
    <a href="{{ route('admin.users') }}" title="späť">
        <<< späť užívatelia </a>
</div>
<h1>Povolenia užívateľa: {{ $user->name }}</h1>

<form action="{{ route('admin.permissions.user', $user->id) }}" method="POST">
    @csrf
    @method('PATCH')

    @include('admin.permissions._form_permission', ['current_permissions' => $user_permissions])
    <div class="row mt-5">
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary"> Uložiť </button>
        </div>
    </div>
</form>

@endsection