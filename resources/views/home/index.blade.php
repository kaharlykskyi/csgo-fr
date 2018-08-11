@extends('layouts.app')

@section('content')

            <!-- START: Image Slider -->
            @component('home.components.image_slider')

            @endcomponent
            <!-- END: Image Slider -->

            <!-- START: Latest News -->
                @component('home.components.latest_news')

                @endcomponent
            <!-- END: Latest News -->

            <div class="nk-gap-2"></div>
            <div class="row vertical-gap">
                <div class="col-lg-8">

                    <!-- START: Latest Matches -->
                        @component('home.components.latest_matches')

                        @endcomponent
                    <!-- END: Latest Matches -->

                {{--
                    <!-- START: Tabbed News  -->
                        @component('home.components.tabbed_news')

                        @endcomponent
                    <!-- END: Tabbed News -->


                    <!-- START: Latest Pictures -->
                        @component('home.components.latest_pictures')

                        @endcomponent
                    <!-- END: Latest Pictures -->

                    <!-- START: Best Selling -->
                        @component('home.components.best_selling')

                        @endcomponent
                    <!-- END: Best Selling -->--}}

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
