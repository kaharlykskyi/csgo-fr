<div class="row form-group">
    <div class="col col-md-3">
        <label for="name" class=" form-control-label">Category`s name</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" id="title" value="@if(isset($newsCategory->id)){{$newsCategory->name}}@else{{old('name')}}@endif" name="name" placeholder="Category`s name" class="form-control" required>
        @if ($errors->has('name'))
            <small class="form-text text-danger">{{ $errors->first('name') }}</small>
        @endif
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary btn-sm">
        <i class="fa fa-dot-circle-o"></i>

        {{__('Save')}}

    </button>
</div>