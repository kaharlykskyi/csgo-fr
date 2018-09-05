@extends('layouts.app')

@section('content')
    <div class="row vertical-gap">
        <div class="col-lg-8">

        @component('admin_area.news.component.breadcrumb',['title' => $news->title])

        @endcomponent

            <div class="nk-widget-highlighted">
                <div class="nk-widget-content p-10">
                    <!-- START: Post -->
                    <div class="nk-blog-post nk-blog-post-single">
                        <!-- START: Post Text -->
                        <div class="nk-post-text mt-0">
                            <div class="nk-post-img">
                                <img src="{{asset('assets/images/news_img/' . $news->banner_image)}}" alt="{{$news->title}}">
                            </div>
                            <div class="nk-gap-1"></div>

                            <div class="nk-post-by">
                                by <a href="#">{{ $news->author_name }}</a> in {{ $news->publication_date }}
                                @isset($news->viewers_count)<span class="fa fa-eye ml-5"></span> {{$news->viewers_count}}@endisset
                            </div>

                            <div class="nk-gap"></div>

                            {!! $news->content_news !!}

                            <div class="nk-gap"></div>
                        </div>
                        <!-- END: Post Text -->
                    </div>
                    <!-- END: Post -->
                </div>
            </div>

            <div class="nk-gap-2"></div>
            <!-- START: Comments -->
                @component('common_component.comments_output',[
                    'comments' => $comments,
                    'count' => $count,
                    'users' => $users,
                    'object' => $news,
                    'url' => route('news_comment_like'),
                    'url_comment' => route('news_comment')
                ])

                @endcomponent
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
            'sort_match' => $sort_match,
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