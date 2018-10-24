<div id="comments"></div>
<h3 class="nk-decorated-h-2"><span><span class="text-main-1">@if($count != 0){{$count}}@else{{__('')}}@endif</span> Comments</span></h3>
<div class="nk-gap"></div>

<div class="nk-comments">

    @include('common_component.partials.comment_trees', [
        'comments' => $comments
    ])
</div>

<!-- START: Reply -->
<div class="nk-gap-2"></div>
<h3 class="nk-decorated-h-2"><span><span class="text-main-1">Leave</span> a Reply</span></h3>
<div class="nk-gap"></div>
<div class="nk-reply">
    <form action="{{$url_comment}}" method="post" id="comment-form" class="nk-form" novalidate="novalidate">
        @csrf
        @if(isset(Auth::user()->id))
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        @endif
        <div id="reply-block"></div>
        <input type="hidden" name="object_id" value="{{$object->id}}">
        <div class="nk-gap-1"></div>
        <textarea name="comment" cols="30" rows="10" class="nk-summernote form-control" placeholder="Message *"></textarea>
        <small class="form-text text-info">start write with : if you wont use emojis. Example - :ra</small>
        <div class="nk-gap-1"></div>
        @if (session('status'))
            <div style="display: block;" class="nk-form-response-error">{{ session('status') }}</div>
        @endif
        <button type="submit" class="nk-btn nk-btn-rounded nk-btn-color-main-1">Post Comment</button>
    </form>
</div>
<script>
    function reply(id,name) {
        $('#reply-block').html('<input type="hidden" name="parent_comment" value=" ' + id + '">' +
            '<div class="input-group input-group-sm mb-3">'+
            '<div class="input-group-prepend">'+
            '<span class="input-group-text" id="inputGroup-sizing-sm">reply</span>'+
            '</div>'+
            '<input type="text" class="form-control" value="'+name+'" aria-label="reply" aria-describedby="inputGroup-sizing-sm">'+
            '</div>');
    }
</script>
<!-- END: Reply -->