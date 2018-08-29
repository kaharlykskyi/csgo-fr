<div class="row form-group">
    <div class="col col-md-3">
        <label for="full_name" class=" form-control-label">Full name</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" id="full_name" value="@if(isset($player->id)){{$player->full_name}}@else{{old('full_name')}}@endif" name="full_name" placeholder="Full name" class="form-control">
        @if ($errors->has('full_name'))
            <small class="form-text text-danger">{{ $errors->first('full_name') }}</small>
        @endif
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label for="nickname" class=" form-control-label">Nickname</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" id="nickname" value="@if(isset($player->id)){{$player->nickname}}@else{{old('nickname')}}@endif" name="nickname" placeholder="Player nickname" class="form-control" required>
        @if ($errors->has('nickname'))
            <small class="form-text text-danger">{{ $errors->first('nickname') }}</small>
        @endif
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label for="age" class=" form-control-label">Age</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" id="age" value="@if(isset($player->id)){{$player->age}}@else{{old('age')}}@endif" name="age" placeholder="Player age" class="form-control">
        @if ($errors->has('age'))
            <small class="form-text text-danger">{{ $errors->first('age') }}</small>
        @endif
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label for="select" class=" form-control-label">Country</label>
    </div>
    <div class="col-12 col-md-9">
        <select name="country" id="select" class="form-control" required>
            <option value="0">Please select country</option>

            @foreach($countries as $country)
                <option @if(isset($player->id) && $player->country == $country->country) selected @endif value="<?php print_r($country->country); ?>"><?php print_r($country->country); ?></option>
            @endforeach

        </select>
        @if ($errors->has('country'))
            <small class="form-text text-danger">{{ $errors->first('country') }}</small>
        @endif
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label for="team_id" class=" form-control-label">Team</label>
    </div>
    <div class="col-12 col-md-9">
        <select name="team_id" id="team_id" class="form-control">
            <option value="0">Please select team</option>

            @isset($teams)
                @foreach($teams as $team)
                    <option @if(isset($player->id) && $player->team_id == $team->id) selected @endif value="<?php print_r($team->id); ?>"><?php print_r($team->name); ?></option>
                @endforeach
            @endisset

        </select>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col col-md-3">
                <label for="logo" class=" form-control-label">Logo</label>
            </div>
            <div class="col col-md-9">
                <div class="input-group">
                    <span class="input-group-btn">
                    <a data-input="thumbnail" data-preview="holder" id="logo_player" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                    </a>
                </span>
                    <input @if(isset($player->id))value="{{$player->logo}}"@endif id="thumbnail" class="form-control" type="text" name="logo">
                </div>
                <img @if(isset($player->id))src="{{$player->logo}}"@endif id="holder" style="margin-top:15px;max-height:100px;">
            </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#logo_player').filemanager('image');
</script>

<div class="card-footer">
    <button type="submit" class="btn btn-primary btn-sm">
        <i class="fa fa-dot-circle-o"></i>

        {{__('Save')}}

    </button>
</div>