@extends('layouts.app')

@section('content')

    <!-- START: Breadcrumbs -->
    @component('forum.component.breadcrumb',[
        'parent_nodes' => [
            (object)['url'=>route('forum_topics'),'data'=> 'Forum']
        ],
        'active' => $topic->title
    ])

    @endcomponent
    <!-- END: Breadcrumbs -->
    <div class="container">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row justify-content-end">
            <div class="col-md-3 text-right">
                <a href="{{route('add_thread')}}" class="nk-btn nk-btn-rounded nk-btn-color-white">New Topic</a>
            </div>
        </div>

        <div class="nk-gap-2"></div>

    <!-- START: Forums List -->
        <ul class="nk-forum">
            @isset($affix_threads)
                @foreach($affix_threads as $thread)
                    <li>
                        <div class="nk-forum-icon">
                            <span class="ion-pin"></span>
                        </div>
                        <div class="nk-forum-title">
                            <h3><a href="{{route('thread_page',['id' => $topic->id, 'thread_id' => $thread->id])}}">{{$thread->title}}</a></h3>
                            <div class="nk-forum-title-sub">Started by <a href="#">
                                    @isset($users)
                                        @foreach($users as $user)
                                            @if($user->id == $thread->user_id)
                                                {{$user->name}}
                                            @endif
                                        @endforeach
                                    @endisset
                                </a> on {{date('M d Y',strtotime($thread->created_at))}}</div>
                        </div>
                        <div class="nk-forum-count">
                            178 posts
                        </div>
                        <div class="nk-forum-activity-avatar">
                            <a href="forum-single-topic.html">
                                <img src="assets/images/avatar-1.jpg" alt="Hitman">
                            </a>
                        </div>
                        <div class="nk-forum-activity">
                            <div class="nk-forum-activity-title" title="Hitman">
                                <a href="#">Hitman</a>
                            </div>
                            <div class="nk-forum-activity-date">
                                September 11, 2018
                            </div>
                        </div>
                    </li>
                @endforeach
            @endisset
            @isset($threads)
                @foreach($threads as $thread)
                    <li class="@if($thread->state == 0){{__('nk-forum-locked')}}@else{{__('')}}@endif">
                        <div class="nk-forum-icon">
                            <span class="@if($thread->state == 0){{__('ion-locked')}}@else{{__('ion-chatboxes')}}@endif"></span>
                        </div>
                        <div class="nk-forum-title">
                            <h3><a href="{{route('thread_page',['id' => $topic->id, 'thread_id' => $thread->id])}}">{{$thread->title}}</a></h3>
                            @isset($thread->description)
                                <div class="nk-forum-title-sub">{{$thread->description}}</div>
                            @endisset
                            <div class="nk-forum-title-sub">Started by
                                <a href="#">
                                    @isset($users)
                                        @foreach($users as $user)
                                            @if($user->id == $thread->user_id)
                                                {{$user->name}}
                                            @endif
                                        @endforeach
                                    @endisset
                                </a> on {{date('M d Y',strtotime($thread->created_at))}}</div>
                        </div>
                        <div class="nk-forum-count">
                            {{\Illuminate\Support\Facades\DB::table('thread_posts')->where('thread_id',$thread->id)->count()}} posts
                        </div>
                        <?php
                            $last_post = \Illuminate\Support\Facades\DB::table('thread_posts')->where('thread_id',$thread->id)->limit(1)->latest()->first();
                            if (isset($last_post->user_id)){
                                $user = \Illuminate\Support\Facades\DB::table('users')->where('id',$last_post->user_id)->first();
                            }
                        ?>
                        <div class="nk-forum-activity-avatar mr-5">
                            @if(is_object($last_post))
                                <a href="{{route('thread_page',['id' => $topic->id, 'thread_id' => $last_post->id])}}">
                                    <img src="@if(isset($user->logo_user)){{asset(''.$user->logo_user)}}@else{{asset('images/photo_not_available.png')}}@endif" alt="Witch Murder">
                                </a>
                            @endif
                        </div>
                        <div class="nk-forum-activity">
                            @if(is_object($last_post))
                                <div class="nk-forum-activity-title" title="Witch Murder">
                                    <a href="{{route('thread_page',['id' => $topic->id, 'thread_id' => $last_post->id])}}">{{$user->name}}</a>
                                </div>
                                <div class="nk-forum-activity-date">
                                    {{date('M d Y',strtotime($last_post->created_at))}}
                                </div>
                            @endif
                        </div>

                    </li>
                @endforeach
            @endisset
        </ul>
        <!-- END: Forums List -->

        <div class="nk-gap-2"></div>

        <!-- START: Pagination -->
        <div class="row">
            <div class="col-md-3 order-md-2 text-right">
                <a href="{{route('add_thread')}}" class="nk-btn nk-btn-rounded nk-btn-color-white">New Topic</a>
            </div>

            <div class="col-md-9">
                {{$threads->links('vendor.pagination.custom')}}
            </div>
        </div>
        <!-- END: Pagination -->

    </div>

    <div class="nk-gap-2"></div>


@endsection