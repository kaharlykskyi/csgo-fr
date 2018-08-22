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
                        {{ $news->publication_date }}
                    </div>

                    <div class="nk-gap"></div>

                    {!! $news->content_news !!}

                    <div class="nk-gap"></div>
                </div>
                <!-- END: Post Text -->
            </div>
            <!-- END: Post -->

        </div>
        <div class="col-lg-4">
            <!--
                START: Sidebar

                Additional Classes:
                    .nk-sidebar-left
                    .nk-sidebar-right
                    .nk-sidebar-sticky
            -->
        @component('common_component.sidebar')

        @endcomponent
        <!-- END: Sidebar -->
        </div>
    </div>

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top-5.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->

@endsection