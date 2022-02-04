@extends('layouts.app')

@section('content')
<div class="float-lef">
    <a href="{{ route('admin.users') }}" title="späť">
        <<< späť užívatelia </a>
</div>
<h1>Skupiny: užívateľ {{ $user->name }}</h1>


<form action="{{route('admin.groups.user', $user->id)}}" method="POST">
    @csrf
    @method('PATCH')
    @foreach($groups as $group)
    <div class="form-group ">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="user_groups_{{ $group->id }}" name="user_groups[]" value="{{ $group->id }}" {{ in_array($group->id, $user_groups->toArray()) ? 'checked' : '' }}>
            <label class="form-check-label" for="user_groups_{{ $group->id }}"> {{ $group->name }} ({{ $group->description }})</label>
        </div>
    </div>
    @endforeach
    <div class="ml-5 mt-4">
        <button type="submit" class="btn btn-primary"> Uložiť </button>
    </div>
</form>


@endsection