<div class="row">
    @foreach($permissions as $permission_group_name => $permission_group)
    <div class="col-4">
        <h1>{{ $permission_group_name }}</h1>



        @foreach($permission_group as $permission)


        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="save_permissions_{{$permission->id}}" name="save_permissions[]" value="{{ $permission->id }}" {{ in_array($permission->id, $current_permissions->toArray()) ? 'checked' : '' }}>
            <label class="form-check-label" for="save_permissions_{{$permission->id}}">{{ $permission->name }}</label>
        </div>

        @endforeach
    </div>
    @endforeach
</div>