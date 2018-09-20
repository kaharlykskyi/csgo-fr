@extends('layouts.app')

@section('content')
    <div class="row vertical-gap">
        <div class="col-lg-8">

            <!-- START: Breadcrumbs -->
                @component('forum.component.breadcrumb',[
                    'parent_nodes' => null,
                    'active' => 'All News'
                ])

                @endcomponent
            <!-- END: Breadcrumbs -->

            <div class="nk-gap-2"></div>
                <div class="nk-widget nk-widget-highlighted">
                    <div class="nk-widget-content">
                        <ul class="nk-widget-categories">
                            @isset($news)
                                @foreach($news as $iteam)
                                    <li>
                                        <div class="news-banner"
                                             style="background-image: url({{asset('assets/images/news_img/' . $iteam->banner_image)}})"></div>
                                        <a class="pb-2" href="{{route('news_page',$iteam->id)}}">{{$iteam->title}}</a>
                                        <em class="small">by <strong>{{$iteam->author_name}}</strong> on {{date('M d Y',strtotime($iteam->publication_date))}}</em>
                                    </li>
                                @endforeach
                            @endisset
                        </ul>
                    </div>
                    <div class="row mt-20">
                        <div class="col-12">
                            {{$news->links('vendor.pagination.custom')}}
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