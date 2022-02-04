@extends('layouts.app')

@section('content')

<h1>Tímy:</h1>
<div class="row gx-4">
    <div class="col">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <td>#</td>
                    <td>Názov tímu:</td>
                    <td>Minimálny vek:</td>
                    <td>Maximálny vek:</td>
                    <td>Upraviť/Vymazať:</td>
                </tr>
            </thead>
            <tbody>
                @foreach($teams as $team_item)
                <tr>
                    <td>{{ $team_item->id }}</td>
                    <td>{{ $team_item->name }}</td>
                    <td>{{ $team_item->min_age }}</td>
                    <td>{{ $team_item->max_age }}</td>
                    <td>
                        <div class="d-inline-block">
                            <a href="{{ route('admin.team.edit', $team_item->id) }}" title="upraviť" class="text-info">
                                <span class="material-icons">
                                    edit
                                </span>
                            </a>
                        </div>
                        <div class="d-inline-block">
                            <form action="{{ route('admin.team.delete', $team_item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button title="vymazať" class="ml-2 text-danger border-0" onclick="if(!confirm('Skutočne chcete vymazať tento tím?')) return false">
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
        <h2>Pridať tím</h2>
        <form action="{{ route('admin.team.add') }}" method="POST">
            @csrf
            @include('admin.teams._form')
        </form>
    </div>
</div>




@endsection