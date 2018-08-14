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
                        <div class="nk-post-share">
                            <span class="h5">Share Article:</span>

                            <ul class="nk-social-links-2">
                                <li><span class="nk-social-facebook" title="Share page on Facebook" data-share="facebook"><span class="fab fa-facebook"></span></span></li>
                                <li><span class="nk-social-google-plus" title="Share page on Google+" data-share="google-plus"><span class="fab fa-google-plus"></span></span></li>
                                <li><span class="nk-social-twitter" title="Share page on Twitter" data-share="twitter"><span class="fab fa-twitter"></span></span></li>
                                <li><span class="nk-social-pinterest" title="Share page on Pinterest" data-share="pinterest"><span class="fab fa-pinterest-p"></span></span></li>

                                <!-- Additional Share Buttons
                                    <li><span class="nk-social-linkedin" title="Share page on LinkedIn" data-share="linkedin"><span class="fab fa-linkedin"></span></span></li>
                                    <li><span class="nk-social-vk" title="Share page on VK" data-share="vk"><span class="fab fa-vk"></span></span></li>
                                -->
                            </ul>
                        </div>
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

    <img class="nk-page-background-top" src="{{ asset('images/bg-top.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->

@endsection