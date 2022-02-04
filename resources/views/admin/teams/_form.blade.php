<div class="row form-group">
    <div class="col-3">
        <label for="name">Názov tímu: </label>
    </div>
    <div class="col-5">
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $team->name) }}">
        @if($errors->has('name'))
        <div class="error_msg">{{ $errors->get('name')[0] }}</div>
        @endif
    </div>
</div>

<div class="row form-group">
    <div class="col-3">
        <label for="min_age">Minimálny vek: </label>
    </div>
    <div class="col-5">
        <input type="number" class="form-control w-1/2" name="min_age" id="min_age" value="{{ old('min_age', $team->min_age) }}">
        @if($errors->has('min_age'))
        <div class=" error_msg">{{ $errors->get('min_age')[0] }}
        </div>
        @endif
    </div>
</div>
<div class="row form-group">
    <div class="col-3">
        <label for="max_age">Maximálny vek: </label>
    </div>
    <div class="col-5">
        <input type="number" class="form-control" name="max_age" id="max_age" value="{{ old('max_age', $team->max_age) }}">
        @if($errors->has('max_age'))
        <div class="error_msg">{{ $errors->get('max_age')[0] }}</div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-12 mt-3 text-center">
        <button class="btn btn-primary"> Uložiť </button>
    </div>
</div>