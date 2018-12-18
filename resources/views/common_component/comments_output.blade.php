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
        <div id="edit-block"></div>
        <div id="reply-block"></div>
        <input type="hidden" name="object_id" value="{{$object->id}}">
        <div class="nk-gap-1"></div>
        <textarea name="comment" cols="30" rows="10" class="nk-summernote form-control" placeholder="Message *"></textarea>
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

    function edit(id,link,type) {
        $('#edit-block').html(`
            <input type="hidden" name="id_comment" value="${id}">
            <input type="hidden" name="type_page" value="${type}">
        `);
        $('#comment-form').attr('action',link);
        $('#comment-form .note-editable.card-block').html($('#post-' + id + ' .comment-content').html());
    }

    function moderStatus(id,type){
        $.get("{{route('moder_status_comment')}}" + '?id=' + id + '&type=' + type,function (data) {
            console.log(data);
        });
    }

    document.body.scrollTop = 0;

    window.scrolled = false;

    var id = null;

    $(document).one('ready scroll hashchange', function(e) {
        if(window.scrolled != false || location.hash.length == 0) return;

        e.preventDefault();

        id = '#' + location.hash.substr(1);
        var el = $(id);

        if(el.size()>0)
        {
            $('body, html').animate({
                scrollTop: el.offset().top
            }, 3000);

            window.scrolled = true;
        }

        $(id).css({
            "box-shadow": "0 5px 20px 20px rgba(0,0,0,0.2)",
            "padding": "10px 15px",
            "border-radius": "20px",
            "margin-top": "10px",
        });
    });

    $(document).ready(function () {
        $(id).hover(function () {
            $(this).css({
                "box-shadow": "none",
                "padding": "20px 0 0",
                "border-radius": "0",
                "margin-top": "0",
            });
        });
    })
</script>
<!-- END: Reply -->