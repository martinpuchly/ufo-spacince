<div class="row form-group">
    <div class="col-3">
        <label for="name">Názov skupiny: </label>
    </div>
    <div class="col-5">
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $group->name) }}">
        @if($errors->has('name'))
        <div class="error_msg">{{ $errors->get('name')[0] }}</div>
        @endif
    </div>
</div>
<div class="row form-group">
    <div class="col-3">
        <label for="description">Popis skupiny: </label>
    </div>
    <div class="col-5">
        <input type="text" class="form-control" name="description" id="description" value="{{ old('description', $group->description) }}">
        @if($errors->has('description'))
        <div class="error_msg">{{ $errors->get('description')[0] }}</div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-12">
        <button class="btn btn-primary"> Uložiť </button>
    </div>
</div>