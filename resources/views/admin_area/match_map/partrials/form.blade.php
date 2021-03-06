<div class="row form-group">
    <div class="col col-md-3">
        <label for="title" class=" form-control-label">Map title</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" id="title" value="@if(isset($matchMap->id)){{$matchMap->title}}@else{{old('title')}}@endif" required name="title" placeholder="Map title" class="form-control">
        @if ($errors->has('title'))
            <small class="form-text text-danger">{{ $errors->first('title') }}</small>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col col-md-3">
                <label for="path" class=" form-control-label">Map`s Image</label>
            </div>
            <div class="col col-md-9">
                <div class="input-group">
                    <span class="input-group-btn">
                    <a data-input="thumbnail" data-preview="holder" id="image" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                    </a>
                </span>
                    <input @if(isset($matchMap->id))value="{{$matchMap->path}}"@endif id="thumbnail" class="form-control" type="text" name="path" required>
                </div>
                <img @if(isset($matchMap->id))src="{{$matchMap->path}}"@endif id="holder" style="margin-top:15px;max-height:100px;">
                @if ($errors->has('path'))
                    <small class="form-text text-danger">{{ $errors->first('path') }}</small>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    $('#image').filemanager('image');
</script>

<div class="card-footer">
    <button type="submit" class="btn btn-primary btn-sm">
        <i class="fa fa-dot-circle-o"></i>

        {{__('Save')}}

    </button>
</div>