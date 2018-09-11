<div class="row form-group">
    <div class="col col-md-3">
        <label for="title" class=" form-control-label">Image title</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" id="title" value="@if(isset($image->id)){{$image->title}}@else{{old('title')}}@endif" name="title" placeholder="Image title" class="form-control">
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
            <textarea id="editor" name="description" rows="9" placeholder="Description..." class="form-control">
                @if(isset($image->id)){{$image->description}}@else{{old('description')}}@endif
            </textarea>
        @if ($errors->has('description'))
            <small class="form-text text-danger">{{ $errors->first('description') }}</small>
        @endif
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="category_id" class=" form-control-label">Category</label>
    </div>
    <div class="col-12 col-md-9">
        <select name="gallery_id" id="select" class="form-control">
            <option value="0">Other</option>

            @foreach($galleres as $val)
                <option @if(isset($image->id) && $image->gallery_id == $val->id) selected @endif value="<?php print_r($val->id); ?>"><?php print_r($val->name); ?></option>
            @endforeach

        </select>
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
                    <input @if(isset($image->id))value="{{$image->path}}"@endif id="thumbnail" class="form-control" type="text" name="path" required>
                </div>
                <img @if(isset($image->id))src="{{$image->path}}"@endif id="holder" style="margin-top:15px;max-height:100px;">
            </div>
        </div>
    </div>
</div>

<script>
    $('#image').filemanager('image');
    CKEDITOR.replace('editor',options);
</script>

<div class="card-footer">
    <button type="submit" class="btn btn-primary btn-sm">
        <i class="fa fa-dot-circle-o"></i>

        {{__('Save')}}

    </button>
</div>