<div class="row form-group">
    <div class="col col-md-3">
        <label for="title" class=" form-control-label">Title</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" id="full_name" value="@if(isset($forumTopic->id)){{$forumTopic->title}}@else{{old('title')}}@endif" name="title" placeholder="Thread's title" class="form-control" required>
        @if ($errors->has('title'))
            <small class="form-text text-danger">{{ $errors->first('title') }}</small>
        @endif
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="description" class=" form-control-label">Description</label>
    </div>
    <div class="col-12 col-md-9">
        <textarea class="form-control" id="description" name="description" aria-label="Topic's title" placeholder="Thread's description">@if(isset($forumTopic->id)){{$forumTopic->description}}@else{{old('description')}}@endif</textarea>
        @if ($errors->has('description'))
            <small class="form-text text-danger">{{ $errors->first('description') }}</small>
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
                    <a data-input="thumbnail" data-preview="holder" id="logo_topic" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                    </a>
                </span>
                    <input @if(isset($forumTopic->id))value="{{$forumTopic->logo}}"@endif id="thumbnail" class="form-control" type="text" name="logo">
                </div>
                <img @if(isset($forumTopic->id))src="{{$forumTopic->logo}}"@endif id="holder" style="margin-top:15px;max-height:100px;">
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $('#logo_topic').filemanager('image');
    CKEDITOR.replace('description',options);
</script>

<div class="card-footer">
    <button type="submit" class="btn btn-primary btn-sm">
        <i class="fa fa-dot-circle-o"></i>

        {{__('Save')}}

    </button>
</div>