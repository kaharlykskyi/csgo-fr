<div class="row form-group">
    <div class="col col-md-3">
        <label for="title" class=" form-control-label">Title</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" id="full_name" value="@if(isset($forumCategory->id)){{$forumCategory->title}}@else{{old('title')}}@endif" name="title" placeholder="Category title" class="form-control" required>
        @if ($errors->has('title'))
            <small class="form-text text-danger">{{ $errors->first('title') }}</small>
        @endif
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary btn-sm">
        <i class="fa fa-dot-circle-o"></i>

        {{__('Save')}}

    </button>
</div>