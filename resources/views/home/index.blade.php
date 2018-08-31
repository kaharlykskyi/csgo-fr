@extends('layouts.app')
@section('content')

            <div class="row vertical-gap">
                <div class="col-lg-8">

                        <!-- START: Latest News -->
                    @component('home.components.latest_news',[
                    'latest_news' =>$latest_news,
                    'countrys' => $countrys,
                    'latest_turnaments' => $latest_turnaments
                    ])

                    @endcomponent
                    <!-- END: Latest News -->

                        <!-- START: Image Slider -->
                    @component('home.components.image_slider')

                    @endcomponent
                    <!-- END: Image Slider -->

                    <div class="tabbed-news-wrapper">
                        <!-- START: Tabbed News  -->
                        @component('home.components.tabbed_news', ['news_tabbed' => $news_tabbed])

                        @endcomponent
                        <!-- END: Tabbed News -->
                    </div>

{{--                    <!-- START: Latest Matches -->
                    @component('home.components.latest_matches',[
                        'latest_match' => $latest_match,
                        'live_match' => $live_match,
                        'upcoming_matches' => $upcoming_matches,
                        'teams' => $teams
                    ])

                    @endcomponent
                    <!-- END: Latest Matches -->--}}

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
