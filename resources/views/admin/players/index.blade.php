@extends('layouts.app')

@section('title', 'hráči')

@section('content')

<h1>Hráči:</h1>
<table class="table">
    <thead class="table-dark">
        <tr>
            <td>#</td>
            <td>Meno: </td>
            <td>Užívateľ: </td>
            <td>Upraviť/Vymazať</td>
        </tr>
    </thead>
    <tbody>
        @foreach($players as $player)
        <tr>
            <td>{{ $player->id }}</td>
            <td>{{ $player->full_name }}</td>
            <td>{{ $player->user->name }}</td>
            <td>

                @can('adminUpdate', $player)
                <div class="d-inline-block">
                    <a href="{{ route('admin.player.edit', $player->slug) }}" title="upraviť" class="text-info">
                        <span class="material-icons">
                            edit
                        </span>
                    </a>
                </div>
                @endcan
                @can('adminDelete', $player)
                <div class="d-inline-block">
                    <form action="{{ route('admin.player.delete', $player->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button title="vymazať" class="ml-2 text-danger border-0" onclick="if(!confirm('Skutočne chcete vymazať tohto hráča?')) return false">
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

@endsection