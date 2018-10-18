@extends('layouts.app')

@section('content')

    <!-- START: Breadcrumbs -->
        @component('forum.component.breadcrumb',[
            'parent_nodes' => null,
            'active' => 'Forum'
        ])

        @endcomponent
    <!-- END: Breadcrumbs -->
    <div class="container bg-dark-2 pt-20">

        <!-- START: Forums List -->

            @isset($topics)
                @foreach($topics as $iteam)
                    @isset($iteam['topics'][0])
                        <div>
                            <h3 class="nk-decorated-h"><span><span class="text-main-1">{{$iteam['category']->title}}</h3>
                            @foreach($iteam['topics'] as $topic)
                                <ul class="nk-forum">
                                    <li>
                                        <div class="nk-forum-icon">
                                            <span class="{{$topic->logo}}"></span>
                                        </div>
                                        <div class="nk-forum-title">
                                            <h3><a href="{{route('topic_page',$topic->id)}}">{{$topic->title}}</a></h3>
                                            @isset($topic->description)
                                                <div class="nk-forum-title-sub">{!! $topic->description !!}</div>
                                            @endisset
                                        </div>
                                        <div class="nk-forum-count">
                                            {{\Illuminate\Support\Facades\DB::table('topic_threads')->where('topic_id',$topic->id)->count()}} threads
                                        </div>
                                        <?php
                                        $last_thread = \Illuminate\Support\Facades\DB::table('topic_threads')->where('topic_id',$topic->id)->whereIn('state',[1,2])->limit(1)->latest()->first();
                                        if (isset($last_thread->user_id)){
                                            $user = \Illuminate\Support\Facades\DB::table('users')->where('id',$last_thread->user_id)->first();
                                        }
                                        ?>
                                        <div class="nk-forum-activity-avatar mr-5">
                                            @if(is_object($last_thread))
                                                <a href="{{route('thread_page',['id' => $topic->id, 'thread_id' => $last_thread->id])}}">
                                                    <img src="@if(isset($user->logo_user)){{asset('assets/images/user_avatar/'.$user->logo_user)}}@else{{asset('images/photo_not_available.png')}}@endif" alt="{{$user->name}}">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="nk-forum-activity">
                                            @if(is_object($last_thread))
                                                <div class="nk-forum-activity-title" title="GodLike the only game that I want to play!">
                                                    <a href="{{route('thread_page',['id' => $topic->id, 'thread_id' => $last_thread->id])}}">{{$last_thread->title}}</a>
                                                </div>
                                                <div class="nk-forum-activity-date">
                                                    {{date('M d Y',strtotime($last_thread->created_at))}}
                                                </div>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    <div class="nk-gap"></div>
                    @endisset
                @endforeach
            @endisset
        <!-- END: Forums List -->

    </div>

    <div class="nk-gap-2"></div>

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top-5.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->


@endsection