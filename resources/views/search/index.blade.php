@extends('layouts.app')

@section('pageTitle', $pageTitle)

@section('content')

    <!-- START: Breadcrumbs -->
    @component('forum.component.breadcrumb',[
        'parent_nodes' => null,
        'active' => 'Search'
    ])

    @endcomponent
    <!-- END: Breadcrumbs -->

    <div class="nk-gap-3"></div>
    <h3><span class="text-main-1">Search for</span> "{{$search}}"</h3>
    <div class="row">
        <div class="col-12">
            @if($news->count() > 0)
                <div class="nk-gap-2"></div>
                <?php
                    $news = $news->all();
                    $prePage = 10;
                    $chunk = array_chunk((array)$news,$prePage);
                    $count = count($chunk);
                ?>

                <h3 class="text-main-1">News</h3>
                <!-- START: Tabs  -->
                <div class="nk-tabs">
                    <div class="tab-content">
                        @foreach($chunk as $k => $val)
                            <div role="tabpanel" class="tab-pane fade @if($k == 0){{__(' show active')}}@endif" id="news-{{$k}}">
                                @foreach($val as $iteam)
                                    <div class="search-iteam">
                                        <a class="pb-2" href="{{route('news_page',$iteam->id)}}">{{$iteam->title}}</a>
                                        <em class="small">by <strong>{{$iteam->author_name}}</strong> on {{date('M d Y',strtotime($iteam->publication_date))}}</em>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <!--
                        Additional Classes:
                            .nav-tabs-fill
                    -->
                    @if($count > 1)
                        <ul class="nav nav-tabs mt-10" role="tablist">
                            @for($i = 0;$i < $count; $i++)
                                <li class="nav-item">
                                    <a class="nav-link @if($i == 0){{__('active')}}@endif p-0" style=" min-width: 35px;" href="#news-{{$i}}" role="tab" data-toggle="tab">{{$i + 1}}</a>
                                </li>
                            @endfor
                        </ul>
                    @endif
                </div>
                <!-- END: Tabs -->
            @endif
        </div>
        <div class="col-12">
            @if($tournaments->count() > 0)
                <div class="nk-gap-2"></div>
                <?php
                $tournaments = $tournaments->all();
                $prePage = 10;
                $chunk = array_chunk($tournaments,$prePage);
                $count = count($chunk);
                ?>

                <h3 class="text-main-1">Tournaments</h3>
                <!-- START: Tabs  -->
                <div class="nk-tabs">
                    <div class="tab-content">
                        @foreach($chunk as $k => $val)
                            <div role="tabpanel" class="tab-pane fade @if($k == 0){{__(' show active')}}@endif" id="news-{{$k}}">
                                @foreach($val as $iteam)
                                    <div class="search-iteam">
                                        <a class="pb-2" href="{{route('tournament_page',$iteam->id)}}">{{$iteam->title}}</a>
                                        <em class="small">by <strong>{{$iteam->author}}</strong> on {{date('M d Y',strtotime($iteam->publication_date))}}</em>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <!--
                        Additional Classes:
                            .nav-tabs-fill
                    -->
                    @if($count > 1)
                        <ul class="nav nav-tabs mt-10" role="tablist">
                            @for($i = 0;$i < $count; $i++)
                                <li class="nav-item">
                                    <a class="nav-link @if($i == 0){{__('active')}}@endif p-0" style=" min-width: 35px;" href="#news-{{$i}}" role="tab" data-toggle="tab">{{$i + 1}}</a>
                                </li>
                            @endfor
                        </ul>
                    @endif
                </div>
                <!-- END: Tabs -->
            @endif
        </div>
        <div class="col-12">
            @if($forum_topics->count() > 0)
                <div class="nk-gap-2"></div>
                <?php
                $forum_topics = $forum_topics->all();
                $prePage = 10;
                $chunk = array_chunk($forum_topics,$prePage);
                $count = count($chunk);
                ?>

                <h3 class="text-main-1">Thread Forum</h3>
                <!-- START: Tabs  -->
                <div class="nk-tabs">
                    <div class="tab-content">
                        @foreach($chunk as $k => $val)
                            <div role="tabpanel" class="tab-pane fade @if($k == 0){{__(' show active')}}@endif" id="news-{{$k}}">
                                @foreach($val as $iteam)
                                    <div class="search-iteam">
                                        <a class="pb-2" href="{{route('topic_page',$iteam->id)}}">{{$iteam->title}}</a>
                                        <em class="small">on {{date('M d Y',strtotime($iteam->created_at))}}</em>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <!--
                        Additional Classes:
                            .nav-tabs-fill
                    -->
                    @if($count > 1)
                        <ul class="nav nav-tabs mt-10" role="tablist">
                            @for($i = 0;$i < $count; $i++)
                                <li class="nav-item">
                                    <a class="nav-link @if($i == 0){{__('active')}}@endif p-0" style=" min-width: 35px;" href="#news-{{$i}}" role="tab" data-toggle="tab">{{$i + 1}}</a>
                                </li>
                            @endfor
                        </ul>
                    @endif
                </div>
                <!-- END: Tabs -->
            @endif
        </div>
        <div class="col-12">
            @if($topic_threads->count() > 0)
                <div class="nk-gap-2"></div>
                <?php
                $topic_threads = $topic_threads->all();
                $prePage = 10;
                $chunk = array_chunk($topic_threads,$prePage);
                $count = count($chunk);
                ?>

                <h3 class="text-main-1">Topics Forum</h3>
                <!-- START: Tabs  -->
                <div class="nk-tabs">
                    <div class="tab-content">
                        @foreach($chunk as $k => $val)
                            <div role="tabpanel" class="tab-pane fade @if($k == 0){{__(' show active')}}@endif" id="news-{{$k}}">
                                @foreach($val as $iteam)
                                    <div class="search-iteam">
                                        <a class="pb-2" href="{{route('thread_page',['id' => $iteam->id_topic,'thread_id' => $iteam->id])}}">{{$iteam->title}}</a>
                                        <em class="small">on {{date('M d Y',strtotime($iteam->created_at))}}</em>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <!--
                        Additional Classes:
                            .nav-tabs-fill
                    -->
                    @if($count > 1)
                        <ul class="nav nav-tabs mt-10" role="tablist">
                            @for($i = 0;$i < $count; $i++)
                                <li class="nav-item">
                                    <a class="nav-link @if($i == 0){{__('active')}}@endif p-0" style=" min-width: 35px;" href="#news-{{$i}}" role="tab" data-toggle="tab">{{$i + 1}}</a>
                                </li>
                            @endfor
                        </ul>
                    @endif
                </div>
                <!-- END: Tabs -->
            @endif
        </div>
    </div>

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top-5.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->

@endsection