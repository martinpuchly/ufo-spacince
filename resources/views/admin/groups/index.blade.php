@extends('layouts.app')

@section('content')

<h1>Skupiny:</h1>
<div class="row">
    <div class="col-6">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <td>#</td>
                    <td>Názov skupiny:</td>
                    <td>Popis skupiny:</td>
                    <td>Povolenia:</td>
                    <td>Upraviť/Vymazať:</td>
                </tr>
            </thead>
            <tbody>
                @foreach($groups as $group_item)
                <tr>
                    <td>{{ $group_item->id }}</td>
                    <td>{{ $group_item->name }}</td>
                    <td>{{ $group_item->description }}</td>
                    <td>
                        @can('setPermission', $group)
                        <a href="{{ route('admin.permissions.group', $group_item->id) }}" title="povolenia">
                            <span class="material-icons">
                                front_hand
                            </span>
                        </a>
                        @endcan
                    </td>
                    <td>
                        @can('update', $group)
                        <div class="d-inline-block">
                            <a href="{{ route('admin.group.edit', $group_item->id) }}" title="upraviť" class="text-info">
                                <span class="material-icons">
                                    edit
                                </span>
                            </a>
                        </div>
                        @endcan
                        @can('delete', $group)
                        <div class="d-inline-block">
                            <form action="{{ route('admin.group.delete', $group_item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button title="vymazať" class="ml-2 text-danger border-0" onclick="if(!confirm('Skutočne chcete vymazať túto skupinu?')) return false">
                                    <span class="material-icons" class="text-danger">
                                        delete_forever
                                    </span>
                                </button>
                            </form>
                        </div>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @can('create', $group)
    <div class="col-6">
        <h2>Pridať skupinu</h2>
        <form action="{{ route('admin.group.add') }}" method="POST">
            @csrf
            @include('admin.groups._form')
        </form>
    </div>
    @endcan
</div>




@endsection