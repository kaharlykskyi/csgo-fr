<div class="row form-group">
    <div class="col col-md-3">
        <label for="title" class=" form-control-label">Title</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" id="title" value="@if(isset($tournament->id)){{$tournament->title}}@else{{old('title')}}@endif" name="title" placeholder="Title news" class="form-control" required>
        @if ($errors->has('title'))
            <small class="form-text text-danger">{{ $errors->first('title') }}</small>
        @endif
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="short_title" class=" form-control-label">Short Title</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" value="@if(isset($tournament->id)){{$tournament->short_title}}@else{{old('short_title')}}@endif" id="short_title" name="short_title" placeholder="Short title news" class="form-control" required>
        <small class="form-text text-muted">maximum length is 45 characters</small>
        @if ($errors->has('short_title'))
            <small class="form-text text-danger">{{ $errors->first('short_title') }}</small>
        @endif
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="editor" class=" form-control-label">Content Tournament</label>
    </div>
    <div class="col-12 col-md-9">
            <textarea id="editor" name="content_tournament" rows="9" placeholder="Content..." class="form-control" required>
                @if(isset($tournament->id)){{$tournament->content_tournament}}@else{{old('content_tournament')}}@endif
            </textarea>
        @if ($errors->has('content_tournament'))
            <small class="form-text text-danger">{{ $errors->first('content_tournament') }}</small>
        @endif
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="banner_image" class=" form-control-label">Tournament banner</label>
    </div>
    <div class="col-12 col-md-9">
        @if(isset($tournament->id))
            <img class="m-t-10 m-b-10" style="width: 100px;" src="{{'/assets/images/tournament_img/'.$tournament->banner_image}}" alt="">
        @endif
        <input type="file" id="banner_image" name="banner_image" class="form-control-file">
        @if ($errors->has('banner_image'))
            <small class="form-text text-danger">{{ $errors->first('banner_image') }}</small>
        @endif
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="select" class=" form-control-label">Country</label>
    </div>
    <div class="col-12 col-md-9">
        <select name="country_id" id="select" class="form-control" required>
            <option value="0">Please select country</option>

            @foreach($countries as $country)
                <option @if(isset($tournament->id) && $tournament->country_id == $country->country) selected @endif value="<?php print_r($country->country); ?>"><?php print_r($country->country); ?></option>
            @endforeach

        </select>
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="publication_date" class=" form-control-label">Date of the publication</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="date" value="@if(isset($tournament->id)){{$tournament->publication_date}}@else{{old('publication_date')}}@endif" id="publication_date" name="publication_date" placeholder="Data publish" class="form-control">
        @if ($errors->has('publication_date'))
            <small class="form-text text-danger">{{ $errors->first('publication_date') }}</small>
        @endif
        @if(isset($tournament->id))
            <script>
                var dateControl = document.querySelector('input[type="date"]');
                dateControl.value = '@if(isset($tournament->id)){{$tournament->publication_date}}@else{{old('publication_date')}}@endif';
            </script>
        @endif
    </div>
</div>

<div class="row form-group">
    <div class="col col-md-3">
        <label for="author" class=" form-control-label">Author's name</label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" id="title" value="@if(isset($tournament->id)){{$tournament->author}}@else{{old('author')}}@endif" name="author" placeholder="Author's name" class="form-control">
        @if ($errors->has('author'))
            <small class="form-text text-danger">{{ $errors->first('author') }}</small>
        @endif
    </div>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary btn-sm">
        <i class="fa fa-dot-circle-o"></i> @if(isset($tournament->id)){{__('Save')}}@else{{__('Next')}}@endif
    </button>
</div>

<script>
    CKEDITOR.replace('editor',options);
</script>