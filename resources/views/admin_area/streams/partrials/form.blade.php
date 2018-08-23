<div class="row form-group">
    <div class="col col-md-3">
        <label for="name" class=" form-control-label">Name stream</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" id="name" value="@if(isset($stream->id)) {{$stream->name}} @else {{old('name')}} @endif" name="name" placeholder="Name stream" class="form-control" required>
        @if ($errors->has('name'))
            <small class="form-text text-danger">{{ $errors->first('name') }}</small>
        @endif
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="link" class=" form-control-label">Link stream</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" id="link" value="@if(isset($stream->id)) {{$stream->link}} @else {{old('link')}} @endif" name="link" placeholder="Link stream" class="form-control" required>
        @if ($errors->has('link'))
            <small class="form-text text-danger">{{ $errors->first('link') }}</small>
        @endif
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label class=" form-control-label">Show in home page</label>
    </div>
    <div class="col col-md-9">
        <label class="switch switch-3d switch-success mr-3">
            <input name="show_homepage" type="checkbox" class="switch-input"
                   @if(isset($stream->id))
                        @if($stream->show_homepage == 'on')
                            checked
                        @else

                        @endif
                   @else checked @endif>
            <span class="switch-label"></span>
            <span class="switch-handle"></span>
        </label>
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary btn-sm">
        <i class="fa fa-dot-circle-o"></i>

        {{__('Save')}}

    </button>
</div>