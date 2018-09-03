
    <div class="row form-group">
        <div class="col col-md-3">
            <label for="title" class=" form-control-label">Title</label>
        </div>
        <div class="col-12 col-md-9">
            <input type="text" id="title" value="@if(isset($news->id)){{$news->title}}@else{{old('title')}}@endif" name="title" placeholder="Title news" class="form-control" required>
            @if ($errors->has('title'))
                <small class="form-text text-danger">{{ $errors->first('title') }}</small>
            @endif
        </div>
    </div>

    <div class="row form-group">
        <div class="col col-md-3">
            <label for="editor" class=" form-control-label">Content News</label>
        </div>
        <div class="col-12 col-md-9">
            <textarea id="editor" name="content_news" rows="9" placeholder="Content..." class="form-control" required>
                @if(isset($news->id)){{$news->content_news}}@else{{old('content_news')}}@endif
            </textarea>
            @if ($errors->has('content_news'))
                <small class="form-text text-danger">{{ $errors->first('content_news') }}</small>
            @endif
        </div>
    </div>

    <div class="row form-group">
        <div class="col col-md-3">
            <label for="banner_image" class=" form-control-label">News banner</label>
        </div>
        <div class="col-12 col-md-9">
            @if(isset($news->id))
                <img class="m-t-10 m-b-10" style="width: 100px;" src="{{'/assets/images/news_img/'.$news->banner_image}}" alt="">
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
                <option>Please select country</option>

                @foreach($countries as $country)
                    <option @if(isset($news->id) && $news->country_id == $country->country) selected @endif value="<?php print_r($country->country); ?>"><?php print_r($country->country); ?></option>
                @endforeach

            </select>
        </div>
    </div>

    <div class="row form-group">
        <div class="col col-md-3">
            <label for="publication_date" class=" form-control-label">Date of the publication</label>
        </div>
        <div class="col-12 col-md-9">
            <input type="date" value="@if(isset($news->id)){{$news->publication_date}}@else{{old('publication_date')}}@endif" id="publication_date" name="publication_date" placeholder="Data publish News" class="form-control">
            @if ($errors->has('publication_date'))
                <small class="form-text text-danger">{{ $errors->first('publication_date') }}</small>
            @endif
            @if(isset($news->id))
                <script>
                    var dateControl = document.querySelector('input[type="date"]');
                    dateControl.value = '@if(isset($news->id)){{$news->publication_date}}@else{{old('publication_date')}}@endif';
                </script>
            @endif
        </div>
    </div>

    <div class="row form-group">
        <div class="col col-md-3">
            <label class=" form-control-label">Show in home page</label>
        </div>
        <div class="col col-md-9">
            <label class="switch switch-3d switch-success mr-3">
                <input name="enabled" type="checkbox" class="switch-input"
                       @if(isset($news->id))
                       @if($news->enabled == 'on')
                            checked
                       @else

                       @endif
                       @endif>
                <span class="switch-label"></span>
                <span class="switch-handle"></span>
            </label>
        </div>
    </div>

    <div class="row form-group">
        <div class="col col-md-3">
            <label for="author_name" class=" form-control-label">Author name</label>
        </div>
        <div class="col-12 col-md-9">
            <input type="text" id="author_name" value="@if(isset($news->id)){{$news->author_name}}@else{{old('author_name')}}@endif" name="author_name" placeholder="Author name" class="form-control">
            @if ($errors->has('author_name'))
                <small class="form-text text-danger">{{ $errors->first('author_name') }}</small>
            @endif
        </div>
    </div>

    <div class="row form-group">
        <div class="col col-md-3">
            <label for="category_id" class=" form-control-label">Category</label>
        </div>
        <div class="col-12 col-md-9">
            <select name="category_id" id="select" class="form-control">
                <option value="0">Please select Category</option>

                @foreach($categories as $val)
                    <option @if(isset($news->id) && $news->category_id == $val->id) selected @endif value="<?php print_r($val->id); ?>"><?php print_r($val->name); ?></option>
                @endforeach

            </select>
        </div>
    </div>


    <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-dot-circle-o"></i>

                {{__('Save')}}

        </button>
    </div>

    <script>
        CKEDITOR.replace('editor',options);
    </script>