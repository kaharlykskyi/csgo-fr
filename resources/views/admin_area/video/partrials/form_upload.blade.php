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

<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col col-md-3">
                <label for="path" class=" form-control-label">Upload video</label>
            </div>
            <div class="col col-md-9">
                <div class="input-group">
                    <span class="input-group-btn">
                    <a data-input="thumbnail" data-preview="holder" id="video" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                    </a>
                </span>
                    <input @if(isset($video->id))value="{{$video->path}}"@endif id="thumbnail" class="form-control" type="text" name="path">
                </div>
                <div class="alert alert-warning m-10" role="alert">
                    mp4 format
                </div>
                <video width="320" height="240" controls>
                    <source @if(isset($video->id))src="{{$video->path}}"@else src="" @endif type="video/mp4" id="holder">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
</div>

<div class="row m-b-15 m-t-15">
    <div class="col-12">
        <div class="row">
            <div class="col col-md-3">
                <label for="logo" class=" form-control-label">Logo</label>
            </div>
            <div class="col col-md-9">
                <div class="input-group">
                    <span class="input-group-btn">
                    <a data-input="thumbnail2" data-preview="holder2" id="logo" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                    </a>
                </span>
                    <input @if(isset($video->id))value="{{$video->logo}}"@endif id="thumbnail2" class="form-control" type="text" name="logo">
                </div>
                <img @if(isset($video->id))src="{{$video->logo}}"@endif id="holder2" style="margin-top:15px;max-height:100px;">
            </div>
        </div>
    </div>
</div>

<script>
    $('#video').filemanager('file');
    $('#logo').filemanager('image');
</script>


<div class="card-footer">
    <button type="submit" class="btn btn-primary btn-sm">
        <i class="fa fa-dot-circle-o"></i>

        {{__('Save')}}

    </button>
</div>