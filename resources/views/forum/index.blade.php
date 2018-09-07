@extends('layouts.app')

@section('content')

    <!-- START: Breadcrumbs -->
        @component('forum.component.breadcrumb',[
            'parent_nodes' => null,
            'active' => 'Forum'
        ])

        @endcomponent
    <!-- END: Breadcrumbs -->
    <div class="container">

        <!-- START: Forums List -->
        <ul class="nk-forum">
            @isset($topics)
                @foreach($topics as $topic)
                    <li>
                        <div class="nk-forum-icon">
                            <img class="rounded topic-avatar" src="@if(asset($topic->logo)){{asset($topic->logo)}}@else{{asset('images/photo_not_available.png')}}@endif" alt="{{$topic->title}}">
                        </div>
                        <div class="nk-forum-title">
                            <h3><a href="{{route('topic_page',$topic->id)}}">{{$topic->title}}</a></h3>
                            @isset($topic->description)
                                <div class="nk-forum-title-sub">{{$topic->description}}</div>
                            @endisset
                        </div>
                        <div class="nk-forum-count">
                            {{\Illuminate\Support\Facades\DB::table('topic_threads')->where('topic_id',$topic->id)->count()}} threads
                        </div>
                        <?php
                            $last_thread = \Illuminate\Support\Facades\DB::table('topic_threads')->where('topic_id',$topic->id)->limit(1)->latest()->first();
                            if (isset($last_thread->user_id)){
                                $user = \Illuminate\Support\Facades\DB::table('users')->where('id',$last_thread->user_id)->first();
                            }
                        ?>
                        <div class="nk-forum-activity-avatar mr-5">
                            @if(is_object($last_thread))
                                <a href="{{route('thread_page',['id' => $topic->id, 'thread_id' => $last_thread->id])}}">
                                    <img src="@if(isset($user->logo_user)){{asset(''.$user->logo_user)}}@else{{asset('images/photo_not_available.png')}}@endif" alt="{{$user->name}}">
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
                @endforeach
            @endisset
        </ul>
        <!-- END: Forums List -->

    </div>

    <div class="nk-gap-2"></div>


@endsection