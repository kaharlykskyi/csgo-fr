<aside class="nk-sidebar nk-sidebar-right nk-sidebar-sticky">

    <!-- START: Scoreboard -->
    @component('common_component.scoreboard', [
        'sort_match' => $sort_match,
        'teams' => $teams
    ])
    @endcomponent
    <!-- END: Scoreboard -->

    <div class="nk-widget nk-widget-highlighted">
        <h4 class="nk-widget-title"><span><span class="text-main-1">LIVE </span> STREAMS</span></h4>
        <div class="nk-widget-content">
            @php
                $stream_count = \Illuminate\Support\Facades\DB::table('settings')->where('name','=','count_streams')->select('value')->first();
            @endphp
            <div class="nk-widget-match p-5">
                @isset($streams)
                    @foreach($streams as $k => $stream)
                        @isset($stream_count)
                            @if(($k + 1) > (int)$stream_count->value)
                                @break
                            @endif
                        @endisset
                        <div class="nk-widget-stream">
                            <span class="nk-widget-stream-status @if($stream['type'] === 'live') {{__('bg-success')}} @else {{__('bg-danger')}} @endif"></span>
                            <div class="nk-widget-stream-name">
                                <a href="{{route('stream_page',['name' => $stream['channel_name'],'service' => $stream['service'],'id' => isset($stream['id']) ? $stream['id']: null])}}">
                                    @isset($stream['country'])
                                        <img style="width: 25px;" class="mr-2 rounded" src="{{asset('images/flag/' . $stream['country']->flag)}}" alt="{{$stream['country']->country}}">
                                    @endisset
                                    @isset($stream['channel_name']){{$stream['channel_name']}}@endisset
                                </a>
                            </div>
                            <span class="nk-widget-stream-count">@if(isset($stream['type']) && $stream['type'] === 'live'){{$stream['views']}} <span class="fa fa-eye"></span> @else {{__('')}} @endif</span>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>

    @php
        $last_forum = \Illuminate\Support\Facades\DB::table('topic_threads')
            ->join('forum_topics','topic_threads.topic_id', '=', 'forum_topics.id')
            ->select(['topic_threads.*','forum_topics.logo','forum_topics.id as id_topic'])
            ->where('topic_threads.state','!=',0)
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();
        $count_latest_forum = \Illuminate\Support\Facades\DB::table('settings')->where('name','=','count_latest_forum')->select('value')->first();
    @endphp
    @isset($last_forum)
        <div class="nk-widget nk-widget-highlighted">
            <h4 class="nk-widget-title"><span><span class="text-main-1">Latest</span> in Forums</span></h4>
            <div class="nk-widget-content">
                <div class="nk-widget-match p-5">
                    @isset($last_forum)
                        @foreach($last_forum as $k => $item)
                            @isset($stream_count)
                                @if(($k + 1) > (int)$count_latest_forum->value)
                                    @break
                                @endif
                            @endisset
                            <a href="{{route('thread_page',['id' => $item->id_topic, 'thread_id' => $item->id])}}">
                                <div class="nk-widget-stream mt-2 mb-2 pr-35 pl-20">
                                    <div class="nk-widget-stream-name">
                                        @isset($item->logo)
                                            <span class="{{$item->logo}} mr-10" style="position: absolute;top: 0;left: 0;"></span>
                                        @endisset
                                        @isset($item->title){{str_limit($item->title)}}@endisset
                                    </div>
                                    <span class="nk-widget-stream-count" style="color: #7f8b92;">
                                    {{\Illuminate\Support\Facades\DB::table('thread_posts')->where('thread_id',$item->id)->count()}}
                                        <span class="fa fa-comments ml-3"></span>
                                </span>
                                </div>
                            </a>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    @endisset

    @php
        $popular_topics = \Illuminate\Support\Facades\DB::select('SELECT `topic_threads`.*, (SELECT count(id) FROM `thread_posts` WHERE `topic_threads`.id = `thread_posts`.thread_id) count FROM `topic_threads` ORDER BY count DESC LIMIT 4;');
        $count_popular_topics = \Illuminate\Support\Facades\DB::table('settings')->where('name','=','count_popular_topic')->select('value')->first();
    @endphp

    @isset($popular_topics)
        <div class="nk-widget nk-widget-highlighted">
            <h4 class="nk-widget-title"><span><span class="text-main-1">Popular </span> Topics</span></h4>
            <div class="nk-widget-content">
                <div class="nk-widget-match p-5">
                    @isset($popular_topics)
                        @foreach($popular_topics as $k => $item)
                            @isset($stream_count)
                                @if(($k + 1) > (int)$count_popular_topics->value)
                                    @break
                                @endif
                            @endisset
                            @php
                                $thread = \Illuminate\Support\Facades\DB::table('forum_topics')->where('id',$item->topic_id)->first();
                            @endphp
                            <a href="{{route('thread_page',['id' => $item->topic_id, 'thread_id' => $item->id])}}">
                                <div class="nk-widget-stream mt-2 mb-2 pr-35 pl-20">
                                    <div class="nk-widget-stream-name">
                                        @isset($thread->logo)
                                            <span class="{{$thread->logo}} mr-10" style="position: absolute;top: 0;left: 0;"></span>
                                        @endisset
                                        @isset($item->title){{$item->title}}@endisset
                                    </div>
                                    <span class="nk-widget-stream-count" style="color: #7f8b92;">
                                    {{$item->count}}
                                        <span class="fa fa-comments ml-3"></span>
                                </span>
                                </div>
                            </a>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    @endisset

    @php
        $video = \Illuminate\Support\Facades\DB::table('video')->orderByDesc('created_at')->first();
    @endphp

    @isset($video)
        <div class="nk-widget nk-widget-highlighted">
            <h4 class="nk-widget-title"><span><span class="text-main-1">Latest</span> Video</span></h4>
            <div class="nk-widget-content">
                @if(isset($video->code))
                    @if(stripos($video->code,'twitch.tv') !==false )
                        <?php $id_vodeo = explode('/',$video->code); ?>
                        <div class="responsive-embed responsive-embed-16x9">
                            <iframe src="https://player.twitch.tv/?autoplay=false&video=v{{end($id_vodeo)}}" frameborder="0" allowfullscreen="true" scrolling="no"></iframe>
                        </div>
                    @elseif(stripos($video->code,'youtu.be') !==false)
                        <?php $link_video = explode('/',$video->code); ?>
                        <iframe type="video" width="100%"  sandbox="allow-scripts allow-same-origin allow-presentation" src="https://www.youtube.com/embed/{{end($link_video)}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        {{--<div class="nk-plain-video" data-video="{{$video->code}}"></div>--}}
                    @endif
                @else
                    <video autoplay controls class="nk-plain-video" @isset($video->logo) poster="{{asset($video->logo)}}"@endisset style="padding-top: 0">
                        <source src="{{asset($video->path)}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            </div>
        </div>
    @endisset

    @php
        $latest_img = \Illuminate\Support\Facades\DB::table('images')->orderByDesc('created_at')->limit(6)->get();
    @endphp

    @isset($latest_img)
        <div class="nk-widget nk-widget-highlighted">
            <h4 class="nk-widget-title"><span><span class="text-main-1">Latest</span> Screenshots</span></h4>
            <div class="nk-widget-content">
                <div class="nk-popup-gallery">
                    <div class="row sm-gap vertical-gap">
                        @foreach($latest_img as $item)
                            <div class="col-sm-6">
                                <div class="nk-gallery-item-box">
                                    <a href="{{asset($item->path)}}" class="nk-gallery-item" data-size="900x500">
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
                    </div>
                </div>
            </div>
        </div>
    @endisset

</aside>