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
            <div class="nk-widget-match p-5">
                @isset($streams)
                    @foreach($streams as $stream)
                        <div class="nk-widget-stream">
                            <span class="nk-widget-stream-status @if($stream['type'] === 'live') {{__('bg-success')}} @else {{__('bg-danger')}} @endif"></span>
                            <div class="nk-widget-stream-name">
                                <a href="{{$stream['link']}}" target="_blank">
                                    @isset($stream['country'])
                                        <img style="width: 25px;" class="mr-2 rounded" src="{{asset('images/flag/' . $stream['country']->flag)}}" alt="{{$stream['country']->country}}">
                                    @endisset
                                    @isset($stream['channel_name']){{$stream['channel_name']}}@endisset
                                </a>
                            </div>
                            <span class="nk-widget-stream-count">@if(isset($stream['type']) && $stream['type'] === 'live'){{$stream['views']}} viewers @else {{__('')}} @endif</span>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>

    <?php
        $last_posts = \Illuminate\Support\Facades\DB::table('thread_posts')
            ->join('topic_threads','thread_posts.thread_id', '=', 'topic_threads.id')
            ->select('thread_posts.*')
            ->where('topic_threads.state','!=',0)
            ->orderByDesc('created_at')
            ->limit(2)
            ->get();
    ?>
    @isset($last_posts)
        <div class="nk-widget nk-widget-highlighted">
            <h4 class="nk-widget-title"><span><span class="text-main-1">Latest</span> in Forums</span></h4>
            @foreach($last_posts as $last_post)
                <div class="nk-last-forum">
                    <div class="nk-post-text">
                        <p>
                            {{str_limit(strip_tags($last_post->text_post), 30, ' ...')}}
                        </p>
                        <div class="nk-news-box-item-date"><span class="fa fa-calendar"></span> {{date('M d Y',strtotime($last_post->created_at))}}</div>
                    </div>
                </div>
            @endforeach
        </div>
    @endisset

    <?php
        $video = \Illuminate\Support\Facades\DB::table('video')->orderByDesc('created_at')->first();
    ?>

    @isset($video)
        <div class="nk-widget nk-widget-highlighted">
            <h4 class="nk-widget-title"><span><span class="text-main-1">Latest</span> Video</span></h4>
            <div class="nk-widget-content">
                @if(isset($video->code))
                    <div class="nk-plain-video" data-video="{{$video->code}}"></div>
                @else
                    <video controls class="nk-plain-video" @isset($video->logo) poster="{{asset($video->logo)}}"@endisset style="padding-top: 0">
                        <source src="{{asset($video->path)}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            </div>
        </div>
    @endisset

    <?php
        $latest_img = \Illuminate\Support\Facades\DB::table('images')->orderByDesc('created_at')->limit(6)->get();
    ?>

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