<div class="row form-group m-t-15">
    <div class="col col-md-3">
        <label for="title" class=" form-control-label">Video title</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" id="title" value="@if(isset($video->id)){{$video->title}}@else{{old('title')}}@endif" name="title" placeholder="Video title" class="form-control">
        @if ($errors->has('title'))
            <small class="form-text text-danger">{{ $errors->first('title') }}</small>
        @endif
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="code" class=" form-control-label">Link</label>
    </div>
    <div class="col-12 col-md-9">
            <input name="code" value="@if(isset($video->id)){{$video->code}}@else{{old('code')}}@endif" placeholder="Link video" class="form-control">
        @if ($errors->has('code'))
            <small class="form-text text-danger">{{ $errors->first('code') }}</small>
        @endif
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary btn-sm">
        <i class="fa fa-dot-circle-o"></i>

        {{__('Save')}}

    </button>
</div>