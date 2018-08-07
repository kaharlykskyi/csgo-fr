@extends('layouts.app')

@section('content')
    <!--Additional Classes: .nk-header-opaque -->
    <header class="nk-header nk-header-opaque">

     <!-- START: Top Contacts -->
        @component('common_component.top_contacts')

        @endcomponent

    <!-- END: Top Contacts -->

        <!--: Navbar
           Additional Classes:
                .nk-navbar-sticky
                .nk-navbar-transparent
                .nk-navbar-autohide-->
        @component('common_component.navbar')

        @endcomponent
    <!-- END: Navbar -->

    </header>



    <!--
    START: Navbar Mobile

    Additional Classes:
    .nk-navbar-left-side
    .nk-navbar-right-side
    .nk-navbar-lg
    .nk-navbar-overlay-content
    -->
    @component('common_component.navbar_mob')

    @endcomponent
    <!-- END: Navbar Mobile -->



    <div class="nk-main">

        <div class="nk-gap-2"></div>



        <div class="container">

            <!-- START: Latest News -->
                @component('home.components.latest_news')

                @endcomponent
            <!-- END: Latest News -->

            <!-- START: Image Slider -->
                @component('home.components.image_slider')

                @endcomponent
            <!-- END: Image Slider -->

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
        </div>

        <div class="nk-gap-4"></div>



        <!-- START: Footer -->
            @component('common_component.footer')

            @endcomponent
        <!-- END: Footer -->


    </div>




    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->




    <!-- START: Search Modal -->
        @component('common_component.search_modal')

        @endcomponent
    <!-- END: Search Modal -->



    <!-- START: Login Modal -->
        @component('common_component.login_modal')

        @endcomponent
    <!-- END: Login Modal -->

@endsection
