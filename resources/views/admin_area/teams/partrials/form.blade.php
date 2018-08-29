<div class="row form-group">
    <div class="col col-md-3">
        <label for="name" class=" form-control-label">Team name</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" id="name" value="@if(isset($team->id)){{$team->name}}@else{{old('name')}}@endif" name="name" placeholder="Team name" class="form-control">
        @if ($errors->has('name'))
            <small class="form-text text-danger">{{ $errors->first('name') }}</small>
        @endif
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="game" class=" form-control-label">Team game</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" id="game" value="@if(isset($team->id)){{$team->game}}@else{{old('game')}}@endif" name="game" placeholder="Team game" class="form-control">
        @if ($errors->has('game'))
            <small class="form-text text-danger">{{ $errors->first('game') }}</small>
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
                <option @if(isset($team->id) && $team->country == $country->country) selected @endif value="<?php print_r($country->country); ?>"><?php print_r($country->country); ?></option>
            @endforeach

        </select>
        @if ($errors->has('country'))
            <small class="form-text text-danger">{{ $errors->first('country') }}</small>
        @endif
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
                    <input @if(isset($team->id))value="{{$team->logo}}"@endif id="thumbnail" class="form-control" type="text" name="logo">
                </div>
                <img @if(isset($team->id))src="{{$team->logo}}"@endif id="holder" style="margin-top:15px;max-height:100px;">
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