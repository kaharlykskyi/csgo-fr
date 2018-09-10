<div class="row form-group">
    <div class="col col-md-3">
        <label for="name" class=" form-control-label">Gallery name</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" id="name" value="@if(isset($gallery->id)){{$gallery->name}}@else{{old('name')}}@endif" name="name" placeholder="Gallery name" class="form-control" required>
        @if ($errors->has('name'))
            <small class="form-text text-danger">{{ $errors->first('name') }}</small>
        @endif
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="description" class=" form-control-label">Description</label>
    </div>
    <div class="col-12 col-md-9">
            <textarea id="editor" name="description" rows="9" placeholder="Description..." class="form-control">
                @if(isset($gallery->id)){{$gallery->description}}@else{{old('description')}}@endif
            </textarea>
        @if ($errors->has('description'))
            <small class="form-text text-danger">{{ $errors->first('description') }}</small>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col col-md-3">
                <label for="logo" class=" form-control-label">Logo Gallery</label>
            </div>
            <div class="col col-md-9">
                <div class="input-group">
                    <span class="input-group-btn">
                    <a data-input="thumbnail" data-preview="holder" id="logo_player" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                    </a>
                </span>
                    <input @if(isset($gallery->id))value="{{$gallery->logo}}"@endif id="thumbnail" class="form-control" type="text" name="logo" required>
                </div>
                <img @if(isset($gallery->id))src="{{$gallery->logo}}"@endif id="holder" style="margin-top:15px;max-height:100px;">
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $('#logo_player').filemanager('image');
    CKEDITOR.replace('editor',options);
</script>

<div class="card-footer">
    <button type="submit" class="btn btn-primary btn-sm">
        <i class="fa fa-dot-circle-o"></i>

        {{__('Save')}}

    </button>
</div>