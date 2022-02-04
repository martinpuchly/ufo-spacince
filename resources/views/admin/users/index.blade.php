@extends('layouts.app')

@section('content')

<h1>Užívatelia:</h1>

<table class="table">
    <thead class="table-dark">
        <tr>
            <td>#</td>
            <td>Používateľské meno:</td>
            <td>E-mailová adresa:</td>
            <td>Skupiny:</td>
            <td>Povolenia:</td>
            <td>Vytvoriť hráča/Upraviť/Vymazať:</td>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user_item)
        <tr>
            <td>{{ $user_item->id }}</td>
            <td>{{ $user_item->name }}
                @if($user_item->player)
                <a href="{{ route('admin.player.edit', ['player' => $user_item->player->slug]) }}" title="{{ $user_item->player->fullName }}">
                    <span class="material-icons" style="color: {{ $user_item->player->status == 1 ? 'green' : 'orange' }}">
                        catching_pokemon
                    </span>
                </a>
                @endif

            </td>
            <td>{{ $user_item->email }}</td>
            <td>
                @can('setGroup', \App\User::class)
                <a href="{{ route('admin.groups.user', $user_item->id) }}" title="skupiny">
                    <span class="material-icons">
                        group
                    </span>
                </a>
                @endcan
            </td>
            <td class="text-center">
                @can('adminCreate', \App\Player::class)
                @if(!$user_item->is_player)
                <a href="{{ route('admin.player.add', ['user' => $user_item->id]) }}" title="vytvoriť hráčsky profil">
                    <span class="material-icons" class="mr-3">
                        person_add
                    </span>
                </a>
                @endif
                @endcan
                @can('setPermission', \App\User::class)
                <a href="{{ route('admin.permissions.user', $user_item->id) }}" title="povolenia">
                    <span class="material-icons">
                        front_hand
                    </span>
                </a>
                @endcan
            </td>
            <td>
                <div class="d-inline-block">
                    @can('delete', \App\User::class)
                    <form action="{{ route('admin.user.delete', $user_item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button title="vymazať" class="ml-2 text-danger border-0" onclick="if(!confirm('Skutočne chcete vymazať tohto užívateľa?')) return false">
                            <span class="material-icons" class="text-danger">
                                delete_forever
                            </span>
                        </button>
                    </form>
                    @endcan
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $users->links() }}
</div>

@endsection