@extends('layouts.app')

@section('content')

<h1>Administrácia:</h1>
<div class="row">
    @foreach($permissions as $permission_group_name => $permission_group)
    <div class="col-4 mb-5">
        <h1>{{ $permission_group_name }}</h1>
        @foreach($permission_group as $permission)
        @if(auth()->user()->hasPermission($permission->key) && $permission->link_in_admin_menu)
        <li>
            <a href="{{ route($permission->route) }}">{{ $permission->name }}</a>
        </li>

        @endif
        @endforeach
    </div>
    @endforeach
</div>



@endsection