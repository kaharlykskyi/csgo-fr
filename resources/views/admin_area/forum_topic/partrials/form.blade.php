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
                <label for="logo-forum" class=" form-control-label">Logo</label>
            </div>
            <div class="col col-md-9">
                <select name="logo" class="selectpicker" id="logo-forum">
                    <option value="ion-ios-game-controller-b" @if($forumTopic->logo == 'ion-ios-game-controller-b') selected @endif data-content='<span class="ion-ios-game-controller-b m-r-10"></span>'></option>
                    <option value="ion-help-buoy" @if($forumTopic->logo == 'ion-help-buoy') selected @endif data-content='<span class="ion-help-buoy"></span>'></option>
                    <option value="ion-playstation" @if($forumTopic->logo == 'ion-playstation') selected @endif data-content='<span class="ion-playstation"></span>'></option>
                    <option value="ion-xbox" @if($forumTopic->logo == 'ion-xbox') selected @endif data-content='<span class="ion-xbox"></span>'></option>
                    <option value="ion-steam" @if($forumTopic->logo == 'ion-steam') selected @endif data-content='<span class="ion-steam"></span>'></option>
                    <option value="ion-fireball" @if($forumTopic->logo == 'ion-fireball') selected @endif data-content='<span class="ion-fireball"></span>'></option>
                </select>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    CKEDITOR.replace('description',options);
</script>

<div class="card-footer">
    <button type="submit" class="btn btn-primary btn-sm">
        <i class="fa fa-dot-circle-o"></i>

        {{__('Save')}}

    </button>
</div>