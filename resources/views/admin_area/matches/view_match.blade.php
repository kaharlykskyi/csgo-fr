@extends('layouts.app')

@section('content')
    <div class="row vertical-gap">
        <div class="col-lg-8">

    @component('admin_area.tournaments.component.breadcrumb',['title' => ''])

    @endcomponent
            {{dump($match)}}
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


        <!-- START: Page Background -->

        <img class="nk-page-background-top" src="{{ asset('images/bg-top.png') }}" alt="">
        <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

        <!-- END: Page Background -->
    </div>
@endsection