@extends('layouts.app')

@section('content')
    <div class="row vertical-gap">
        <div class="col-lg-8">

        @component('gallery.component.breadcrumb',[
            'parent_nodes' => [
                (object)['url'=>route('gallery'),'data'=> 'Gallery']
            ],
            'active' => $gallery->name
        ])

        @endcomponent

            <div class="nk-gap-2"></div>
            <div class="nk-popup-gallery">
                <div class="row vertical-gap">
                    @isset($images)
                        @foreach($images as $item)
                            <div class="col-lg-4 col-md-6">
                                <div class="nk-gallery-item-box">
                                    <a href="{{asset($item->path)}}" class="nk-gallery-item" data-size="900x572">
                                        <div class="nk-gallery-item-overlay"><span class="ion-eye"></span></div>
                                        <img src="{{asset($item->path)}}" alt="">
                                    </a>
                                    @isset($item->title)
                                        <div class="nk-gallery-item-description">
                                            <h4>{{$item->title}}</h4>
                                            @isset($item->description)
                                                {!! $item->description !!}
                                            @endisset
                                        </div>
                                    @endisset
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>

            <div class="nk-gap"></div>
                <!-- START: Pagination -->
                {{$images->links('vendor.pagination.custom')}}
                <!-- END: Pagination -->
            <div class="nk-gap-2"></div>

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