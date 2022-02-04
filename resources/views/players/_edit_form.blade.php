<input type="hidden" name="player_id" value="{{ $player->id }}">
<div class="row">
    <div class="col-8">
        <div class="row">
            <div class="col-6 form-group">
                <label for="first_name" class="label-larger">Meno:</label>

                <input type="text" class="form-control" name="first_name" id="first_name" value="{{  $player->first_name }}">
                @if($errors->has('first_name'))
                <div class="error_msg">{{ $errors->get('first_name')[0] }}</div>
                @endif
                @if($errors->has('slug'))
                <div class="error_msg">{{ $errors->get('slug')[0] }}</div>
                @endif
            </div>
            <div class="col-6 form-group">
                <label for="last_name" class="label-larger">Priezvisko:</label>
                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $player->last_name }}">
                @if($errors->has('last_name'))
                <div class="error_msg">{{ $errors->get('last_name')[0] }}</div>
                @endif
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-4 form-group">
                <label for="nickname" class="label-larger">Prezývka:</label>

                <input type="text" class="form-control" name="nickname" id="nickname" value="{{  $player->nickname }}">
                @if($errors->has('nickname'))
                <div class="error_msg">{{ $errors->get('nickname')[0] }}</div>
                @endif
            </div>
            <div class="col-4 form-group">
                <label for="shirt_number" class="label-larger">Číslo dresu:</label>

                <input type="number" class="form-control" name="shirt_number" id="shirt_number" value="{{  $player->shirt_number }}">
                @if($errors->has('shirt_number'))
                <div class="error_msg">{{ $errors->get('shirt_number')[0] }}</div>
                @endif
            </div>

        </div>
        <div class="row mt-4">
            <div class="col-4 form-group">
                <div>
                    <label for="shirt_number" class="label-larger">Pohlavie:</label>
                    <select name="sex" id="sex" class="form-select">
                        <option value="">-- pohlavie -- </option>
                        @foreach(\App\Player::SEX as $key => $sex)
                        <option value="{{ $key }}" {{ $player->sex == $key ? 'selected' : '' }}>{{ $sex }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('sex'))
                    <div class="error_msg">{{ $errors->get('sex')[0] }}</div>
                    @endif
                </div>
                <div class="mt-3">
                    <label for="birth_date" class="label-larger">Dátum narodenia:</label>

                    <input type="date" class="form-control" name="birth_date" id="birth_date" value="{{  $player->birth_date }}">
                    @if($errors->has('birth_date'))
                    <div class="error_msg">{{ $errors->get('birth_date')[0] }}</div>
                    @endif
                </div>
            </div>
            <div class="col-8 form-group">
                <label for="about" class="label-larger">O mne:</label>
                <textarea name="about" id="about" class="form-control" style="height:8em"></textarea>
                @if($errors->has('birth_date'))
                <div class="error_msg">{{ $errors->get('birth_date')[0] }}</div>
                @endif
            </div>
        </div>
        <div class="row mt-5">
            <h3>Nastavenia:</h3>
            <div class="row">
                <div class="col-7">
                    <label for="show_profile" class="label-larger">Kto môže vidieť môj hráčsky profil?</label>
                    <select class="form-select form-select-sm mb-3" aria-label=".form-select-lg example" name="show_profile">
                        @foreach(\App\Player::PRIVACY_OPTIONS as $key => $option)
                        <option value="{{ $key }}" {{ $player->show_profile == $key ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-7">
                    <label for="show_birth_date" class="label-larger">Kto môže vidieť môj vek/dátum narodenia?</label>
                    <select class="form-select form-select-sm mb-3" aria-label=".form-select-lg example" name="show_birth_date">
                        @foreach(\App\Player::PRIVACY_OPTIONS as $key => $option)
                        <option value="{{ $key }}" {{ $player->show_birth_date == $key ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-7">
                    <label for="show_photo" class="label-larger">Kto môže vidieť môju fotku?</label>
                    <select class="form-select form-select-sm mb-3" aria-label=".form-select-lg example" name="show_photo">
                        @foreach(\App\Player::PRIVACY_OPTIONS as $key => $option)
                        <option value="{{ $key }}" {{ $player->show_photo == $key ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <img src="{{ $player->img_photo }}" alt="fotka" class="img-thumbnail">
        <div class="mb-3">
            <label for="photo" class="form-label label-larger">Fotka</label>
            <input class="form-control" type="file" id="photo" name="photo">
        </div>
        @if($errors->has('photo'))
        <div class="error_msg">{{ $errors->get('photo')[0] }}</div>
        @endif
    </div>
</div>