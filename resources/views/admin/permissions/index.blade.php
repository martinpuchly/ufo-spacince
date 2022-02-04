@extends('layouts.app')

@section('content')

<h1>Povolenia:</h1>
<div class="row gx-4">
    <div class="col">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <td>#</td>
                    <td>Časť:</td>
                    <td>Názov povolenia:</td>
                    <td>Key:</td>
                    <td>Route:</td>
                    <td>Upraviť/Vymazať:</td>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission_item)
                <tr>
                    <td>{{ $permission_item->id }}</td>
                    <td>{{ $permission_item->name }}</td>
                    <td>{{ $permission_item->main_name }}</td>
                    <td>{{ $permission_item->key }}</td>
                    <td>{{ $permission_item->route }}</td>
                    <td>
                        <div class="d-inline-block">
                            <a href="{{ route('admin.permission.edit', $permission_item->id) }}" title="upraviť" class="text-info">
                                <span class="material-icons">
                                    edit
                                </span>
                            </a>
                        </div>
                        <div class="d-inline-block">
                            <form action="{{ route('admin.permission.delete', $permission_item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button title="vymazať" class="ml-2 text-danger border-0" onclick="if(!confirm('Skutočne chcete vymazať toto povolenie?')) return false">
                                    <span class="material-icons" class="text-danger">
                                        delete_forever
                                    </span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col">
        <h2>Pridať povolenie</h2>
        <form action="{{ route('admin.permission.add') }}" method="POST">
            @csrf
            @include('admin.permissions._form')
        </form>
    </div>
</div>




@endsection