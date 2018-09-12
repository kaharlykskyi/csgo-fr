@extends('layouts.app')

@section('content')

    <!-- START: Breadcrumbs -->
    @component('forum.component.breadcrumb',[
        'parent_nodes' => [
            (object)['url'=>route('forum_topics'),'data'=> 'Forum'],
            (object)['url'=>route('topic_page',$topic->id),'data'=> $topic]
        ],
        'active' => $thread->title
    ])

    @endcomponent
    <!-- END: Breadcrumbs -->

    <div class="container">
        <!-- START: Pagination -->
        <div class="row justify-content-end">
            <div class="col-md-3 text-right">
                <a href="#forum-reply" class="nk-btn nk-btn-rounded nk-btn-color-white nk-anchor">Reply</a>
            </div>
        </div>
        <!-- END: Pagination -->

        <div class="nk-gap-2"></div>

        <!-- START: Forums List -->
        <ul class="nk-forum nk-forum-topic">
            @isset($posts)
                @include('forum.partials.posts_treas', [
                    'posts' => $posts,
                    'users' => $users
                ])
            @endisset
        </ul>
        <!-- END: Forums List -->

        <div class="nk-gap-2"></div>

        <!-- START: Pagination -->
            {{$posts->links('vendor.pagination.custom')}}
        <!-- END: Pagination -->

        <div id="forum-reply"></div>
        <div class="nk-gap-4"></div>
        <!-- START: Reply -->
        <form action="{{route('create_post')}}" method="post" novalidate id="reply-post">
            <h3 class="h4">Reply</h3>
            <div class="nk-gap-1"></div>
            <div id="id-post-reply"></div>
            <input type="hidden" value="{{$thread->id}}" name="thread_id">
            @csrf
            <textarea name="text_post" cols="30" rows="10" class="nk-summernote form-control" required>{{old('title')}}</textarea>
            @if ($errors->has('text_post'))
                <small class="form-text text-danger">{{ $errors->first('text_post') }}</small>
            @endif
            <div class="nk-gap-1"></div>
            <button type="submit" class="nk-btn nk-btn-rounded nk-btn-color-white">Reply</button>
        </form>
        <!-- END: Reply -->
    </div>

    <script>
        function addField(id) {
            $('#id-post-reply').html('<input type="hidden" value="'+id+'" name="parent_post">');
            var contentPost = $('#post-' + id + ' .nk-forum-topic-content').html();
            $('#reply-post .note-editable.card-block').html('<blockquote>'+contentPost+'</blockquote><p><br></p>');
            console.log(contentPost);

        }
    </script>

    <div class="nk-gap-2"></div>


@endsection