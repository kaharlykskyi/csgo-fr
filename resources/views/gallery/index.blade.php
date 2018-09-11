@extends('layouts.app')

@section('content')
    <div class="row vertical-gap">
        <div class="col-lg-8">

            @component('gallery.component.breadcrumb',[
                'parent_nodes' => null,
                'active' => 'Gallery'
            ])

            @endcomponent

            <!-- START: Latest Pictures -->
            @component('gallery.component.latest_pictures',['latest_img' => $latest_img])

            @endcomponent
            <!-- END: Latest Pictures -->

            <!-- START: Recent Galleries-->
            @component('gallery.component.latest_gallery',['latest_gallery' => $latest_gallery])

            @endcomponent
            <!-- END: Recent Galleries -->

            <!-- START: Video Galleries-->
            @component('gallery.component.video',['video' => $video])

            @endcomponent
            <!-- END: Video Galleries -->

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