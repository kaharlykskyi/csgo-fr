<div class="row form-group">
    <div class="col col-md-3">
        <label for="title" class=" form-control-label">Image title</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" id="title" value="@if(isset($bannerImage->id)){{$bannerImage->title}}@else{{old('title')}}@endif" name="title" placeholder="Image title" class="form-control">
        @if ($errors->has('title'))
            <small class="form-text text-danger">{{ $errors->first('title') }}</small>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col col-md-3">
                <label for="path" class=" form-control-label">Image</label>
            </div>
            <div class="col col-md-9">
                <div class="input-group">
                    <span class="input-group-btn">
                    <a data-input="thumbnail" data-preview="holder" id="image" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                    </a>
                </span>
                    <input @if(isset($bannerImage->id))value="{{$bannerImage->img}}"@endif id="thumbnail" class="form-control" type="text" name="img" required>
                </div>
                <img @if(isset($bannerImage->id))src="{{$bannerImage->img}}"@endif id="holder" style="margin-top:15px;max-height:100px;">
            </div>
        </div>
    </div>
</div>

<div class="row form-group mt-5">
    <div class="col col-md-3">
        <label for="title" class=" form-control-label">Link</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" id="title" value="@if(isset($bannerImage->id)){{$bannerImage->link}}@else{{old('link')}}@endif" name="link" placeholder="Banner Link" class="form-control">
        @if ($errors->has('link'))
            <small class="form-text text-danger">{{ $errors->first('link') }}</small>
        @endif
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