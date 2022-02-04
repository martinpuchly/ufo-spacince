<div class="row">
    <div class="col-4">
        <span class="placeholder col-12 placeholder-lg"></span>

    </div>
    <div class="col-4 form-group">

        <label for="first_name" class="label-larger">Meno:</label>

        <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name', $player->first_name) }}">
        @if($errors->has('first_name'))
        <div class="error_msg">{{ $errors->get('first_name')[0] }}</div>
        @endif
    </div>
    <div class="col-4 form-group">
        <label for="last_name" class="label-larger">Priezvisko:</label>
        <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name', $player->last_name) }}">
        @if($errors->has('last_name'))
        <div class="error_msg">{{ $errors->get('last_name')[0] }}</div>
        @endif

    </div>
</div>











<div class="row">
    <div class="col-12 mt-3 text-center">
        <button class="btn btn-primary"> Uložiť </button>
    </div>
</div>