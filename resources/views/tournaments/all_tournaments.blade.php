@extends('layouts.app')

@section('content')
    <div class="row vertical-gap">
        <div class="col-lg-8">
            <!-- START: Breadcrumbs -->
                @component('forum.component.breadcrumb',[
                    'parent_nodes' => null,
                    'active' => 'All Tournaments'
                ])

                @endcomponent
            <!-- END: Breadcrumbs -->

            <div class="nk-gap-2"></div>
            <div class="nk-widget nk-widget-highlighted">
                <div class="nk-widget-content">
                    <ul class="nk-widget-categories">
                        @isset($tournament)
                            @foreach($tournament as $iteam)
                                <li class="border-bottom mb-10">
                                    <img style="width: 100%" src="{{asset('assets/images/tournament_img/' . $iteam->banner_image)}}" alt="">
                                    <a class="pb-2" href="{{route('tournament_page',$iteam->id)}}">{{$iteam->title}}</a>
                                    <em class="small">start {{date('M d Y',strtotime($iteam->publication_date))}}</em>
                                    <div class="nk-post-date mt-10 mb-10">
                                        <span class="fa fa-comments"></span>
                                        {{\Illuminate\Support\Facades\DB::table('tournament_comments')->where('tournament_id',$iteam->id)->count()}} comments
                                        @isset($iteam->viewers_count)<span class="fa fa-eye"></span> {{$iteam->viewers_count}}@endisset
                                    </div>
                                </li>
                            @endforeach
                        @endisset
                    </ul>
                </div>
                <div class="row mt-20">
                    <div class="col-12">
                        {{$tournament->links('vendor.pagination.custom')}}
                    </div>
                </div>
            </div>


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