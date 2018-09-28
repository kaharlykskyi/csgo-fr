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
                <a href="{{route('add_thread')}}" class="nk-btn nk-btn-rounded nk-btn-color-white" @guest onclick="alert('Sorry, you are not logged in'); return false;" @endguest>New Topic</a>
            </div>
        </div>

        <div class="nk-gap-2"></div>

        @guest

        @endguest

    <!-- START: Forums List -->
        <ul class="nk-forum">
            @isset($affix_threads)
                @foreach($affix_threads as $thread)
                    <li class="thread-wrapper">
                        @isset(Auth::user()->role)
                            @if(Auth::user()->role == 'admin')
                                <div class="thread-action-wrapper" style="top: 25px;">
                                    <a href="{{route('thread_action',['id' => $thread->id,'action' => 'unpick'])}}">
                                        <i class="fa fa-comments" aria-hidden="true"></i>
                                    </a>
                                    @if($thread->state == 2)
                                        <a href="{{route('thread_action',['id' => $thread->id,'action' => 'lock'])}}">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        </a>
                                    @elseif($thread->state == 0)
                                        <a href="{{route('thread_action',['id' => $thread->id,'action' => 'unlock'])}}">
                                            <i class="fa fa-unlock" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                    <a href="{{route('thread_action',['id' => $thread->id,'action' => 'delete'])}}" onclick="if(confirm('DELETE?')){return true}else{return false}">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </div>
                            @endif
                        @endisset
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
                                </a> on {{date('M d Y H:i',strtotime($thread->created_at))}}</div>
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
                                    <img src="@if(isset($user->logo_user)){{asset('assets/images/user_avatar/'.$user->logo_user)}}@else{{asset('images/photo_not_available.png')}}@endif" alt="Witch Murder">
                                </a>
                            @endif
                        </div>
                        <div class="nk-forum-activity">
                            @if(is_object($last_post))
                                <div class="nk-forum-activity-title" title="Witch Murder">
                                    <a href="{{route('thread_page',['id' => $topic->id, 'thread_id' => $last_post->id])}}">{{$user->name}}</a>
                                </div>
                                <div class="nk-forum-activity-date">
                                    {{date('M d Y H:i',strtotime($last_post->created_at))}}
                                </div>
                            @endif
                        </div>
                    </li>
                @endforeach
            @endisset
            @isset($threads)
                @foreach($threads as $thread)
                    <li class="@if($thread->state == 0){{__('nk-forum-locked')}}@else{{__('')}}@endif thread-wrapper">
                        @isset(Auth::user()->role)
                            @if(Auth::user()->role == 'admin')
                                <div class="thread-action-wrapper">
                                    <a href="{{route('thread_action',['id' => $thread->id,'action' => 'pick'])}}">
                                        <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                                    </a>
                                    @if($thread->state == 1)
                                        <a href="{{route('thread_action',['id' => $thread->id,'action' => 'lock'])}}">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        </a>
                                    @elseif($thread->state == 0)
                                        <a href="{{route('thread_action',['id' => $thread->id,'action' => 'unlock'])}}">
                                            <i class="fa fa-unlock" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                    <a href="{{route('thread_action',['id' => $thread->id,'action' => 'delete'])}}" onclick="if(confirm('DELETE?')){return true}else{return false}">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </div>
                            @endif
                        @endisset
                        <div class="nk-forum-icon">
                            <span class="@if($thread->state == 0){{__('ion-locked')}}@else{{__('ion-chatboxes')}}@endif"></span>
                        </div>
                        <div class="nk-forum-title">
                            <h3><a href="@if($thread->state == 1){{route('thread_page',['id' => $topic->id, 'thread_id' => $thread->id])}}@endif">{{$thread->title}}</a></h3>
                            <div class="nk-forum-title-sub">Started by
                                <a href="#">
                                    @isset($users)
                                        @foreach($users as $user)
                                            @if($user->id == $thread->user_id)
                                                {{$user->name}}
                                            @endif
                                        @endforeach
                                    @endisset
                                </a> on {{date('M d Y H:i',strtotime($thread->created_at))}}</div>
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
                                <a href="@if($thread->state == 1){{route('thread_page',['id' => $topic->id, 'thread_id' => $last_post->id])}}@endif">
                                    <img src="@if(isset($user->logo_user)){{asset('assets/images/user_avatar/'.$user->logo_user)}}@else{{asset('images/photo_not_available.png')}}@endif" alt="Witch Murder">
                                </a>
                            @endif
                        </div>
                        <div class="nk-forum-activity">
                            @if(is_object($last_post))
                                <div class="nk-forum-activity-title" title="Witch Murder">
                                    <a href="@if($thread->state == 1){{route('thread_page',['id' => $topic->id, 'thread_id' => $last_post->id])}}@endif">{{$user->name}}</a>
                                </div>
                                <div class="nk-forum-activity-date">
                                    {{date('M d Y H:i',strtotime($last_post->created_at))}}
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
                <a href="{{route('add_thread')}}" class="nk-btn nk-btn-rounded nk-btn-color-white" @guest onclick="alert('Sorry, you are not logged in'); return false;" @endguest>New Topic</a>
            </div>

            <div class="col-md-9">
                {{$threads->links('vendor.pagination.custom')}}
            </div>
        </div>
        <!-- END: Pagination -->

    </div>

    <div class="nk-gap-2"></div>

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top-5.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->

@endsection