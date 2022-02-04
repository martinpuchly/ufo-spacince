<div class="row form-group">
    <div class="col-3">
        <label for="main_name">Časť:</label>
    </div>
    <div class="col-5">
        <input type="text" class="form-control" name="main_name" id="main_name" value="{{ old('main_name', $permission->main_name) }}">
        @if($errors->has('main_name'))
        <div class="error_msg">{{ $errors->get('main_name')[0] }}</div>
        @endif
    </div>
</div>
<div class="row form-group">
    <div class="col-3">
        <label for="name">Názov povolenia: </label>
    </div>
    <div class="col-5">
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $permission->name) }}">
        @if($errors->has('name'))
        <div class="error_msg">{{ $errors->get('name')[0] }}</div>
        @endif
    </div>
</div>

<div class="row form-group">
    <div class="col-3">
        <label for="name">Kľúč povolenia: </label>
    </div>
    <div class="col-5">
        <input type="text" class="form-control" name="key" id="key" value="{{ old('key', $permission->key) }}">
        @if($errors->has('key'))
        <div class="error_msg">{{ $errors->get('key')[0] }}</div>
        @endif
    </div>
</div>

<div class="row form-group">
    <div class="col-3">
        <label for="route">Route: </label>
    </div>
    <div class="col-5">
        <input type="text" class="form-control" name="route" id="route" value="{{ old('route', $permission->route) }}">
        @if($errors->has('route'))
        <div class="error_msg">{{ $errors->get('route')[0] }}</div>
        @endif
    </div>
</div>
<div class="row form-group">
    <div class="col-3">
        <label for="link_in_admin_menu">Link v admin menu: </label>
    </div>
    <div class="col-5">
        <input type="checkbox" class="form-control-checkbox" name="link_in_admin_menu" id="link_in_admin_menu" {{ $permission->link_in_admin_menu ? 'checked' : '' }}>
        @if($errors->has('link_in_admin_menu'))
        <div class="error_msg">{{ $errors->get('link_in_admin_menu')[0] }}</div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-12 mt-3 text-center">
        <button class="btn btn-primary"> Uložiť </button>
    </div>
</div>