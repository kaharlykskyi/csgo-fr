@extends('layouts.app')

@section('content')
    <div class="row vertical-gap">
        <div class="col-lg-8">

        @component('admin_area.news.component.breadcrumb',['title' => $news->title])

        @endcomponent

        <!-- START: Post -->
            <div class="nk-blog-post nk-blog-post-single">
                <!-- START: Post Text -->
                <div class="nk-post-text mt-0">
                    <div class="nk-post-img">
                        <img src="{{asset('assets/images/news_img/' . $news->banner_image)}}" alt="{{$news->title}}">
                    </div>
                    <div class="nk-gap-1"></div>
                    <h1 class="nk-post-title h4">{{$news->title}}</h1>

                    <div class="nk-post-by">
                        by <a href="#">{{ $news->author_name }}</a> in {{ $news->publication_date }}
                    </div>

                    <div class="nk-gap"></div>

                    {!! $news->content_news !!}

                    <div class="nk-gap"></div>
                </div>
                <!-- END: Post Text -->
            </div>
            <!-- END: Post -->

            <div class="nk-gap-2"></div>
            <!-- START: Comments -->
            <div id="comments"></div>
            <h3 class="nk-decorated-h-2"><span><span class="text-main-1">@if($count != 0){{$count}}@else{{__('')}}@endif</span> Comments</span></h3>
            <div class="nk-gap"></div>

            <div class="nk-comments">

                @forelse($comments as $comment)
                <!-- START: Comment -->
                    <div class="nk-comment">
                        <div class="nk-comment-meta">
                            by
                            @foreach($users as $user)
                                @if($user->id == $comment->user_id)
                                    <a href="#">
                                        {{$user->name}}
                                    </a>
                                @endif
                            @endforeach
                            in {{$comment->created_at}}
                        </div>
                        <div class="nk-comment-text">
                            <p>{{$comment->comment}}</p>
                        </div>
                    </div>
                    <!-- END: Comment -->
                @empty
                @endforelse
                <ul class="pagination">
                    {{$comments->links()}}
                </ul>

            </div>

            <!-- START: Reply -->
            <div class="nk-gap-2"></div>
            <h3 class="nk-decorated-h-2"><span><span class="text-main-1">Leave</span> a Reply</span></h3>
            <div class="nk-gap"></div>
            <div class="nk-reply">
                <form action="{{route('news_comment')}}" method="post" class="nk-form" novalidate="novalidate">
                    @csrf
                    @if(isset(Auth::user()->id))
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    @endif
                    <input type="hidden" name="news_id" value="{{$news->id}}">
                    <textarea class="form-control required" name="comment" rows="5" placeholder="Message *" aria-required="true"></textarea>
                    <div class="nk-gap-1"></div>
                    @if (session('status'))
                        <div style="display: block;" class="nk-form-response-error">{{ session('status') }}</div>
                    @endif
                    <button type="submit" class="nk-btn nk-btn-rounded nk-btn-color-main-1">Post Comment</button>
                </form>
            </div>
            <!-- END: Reply -->
            <!-- END: Comments -->

        </div>
        <div class="col-lg-4">
            <!--
                START: Sidebar

                Additional Classes:
                    .nk-sidebar-left
                    .nk-sidebar-right
                    .nk-sidebar-sticky
            -->
        @component('common_component.sidebar',[
            'streams' => $streams_output,
            'latest_match' => $latest_match,
            'live_match' => $live_match,
            'upcoming_matches' => $upcoming_matches,
            'teams' => $teams
        ])

        @endcomponent
        <!-- END: Sidebar -->
        </div>
    </div>

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top-5.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->

@endsection