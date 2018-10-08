<div class="row p-0">
    <div class="col-12 col-md-6 col-lg-12">
        <div class="nk-widget nk-widget-highlighted">
            <h4 class="nk-widget-title"><span><span class="text-main-1">Latest in Forums</span> posts</span></h4>
            @isset($last_forum_mass)
                <div class="nk-widget-content">
                    @foreach($last_forum_mass as $item)
                        <div class="nk-widget-match p-5">
                            <a href="{{route('thread_page',['id' => $item->id_topic, 'thread_id' => $item->id_thread])}}">
                                <div class="nk-widget-stream mt-2 mb-2">
                                    <div class="nk-widget-stream-name">
                                        {{str_limit(strip_tags($item->text_post), 50, ' ...')}}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endisset
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-12 mt-20">
        <div class="nk-widget nk-widget-highlighted">
            <h4 class="nk-widget-title"><span><span class="text-main-1">Latest in Forums</span>  topics</span></h4>
            @isset($last_forum_topic)
                <div class="nk-widget-content">
                    @foreach($last_forum_topic as $item)
                        <div class="nk-widget-match p-5">
                            <a href="{{route('thread_page',['id' => $item->id_topic, 'thread_id' => $item->id])}}">
                                <div class="nk-widget-stream mt-2 mb-2">
                                    <div class="nk-widget-stream-name">
                                        {{str_limit(strip_tags($item->title), 50, ' ...')}}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endisset
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-12 mt-20">
        @isset($comments)
            <div class="nk-widget nk-widget-highlighted">
                <h4 class="nk-widget-title"><span><span class="text-main-1">Latest</span> Comments</span></h4>
                <div class="nk-widget-content">
                    @foreach($comments as $item)
                        <div class="nk-widget-match p-5">
                            <a href="
                                            @isset($item->match_id)
                            {{route('match_page',$item->match_id)}}
                            @endisset
                            @isset($item->news_id)
                            {{route('news_page',$item->news_id)}}
                            @endisset
                            @isset($item->tournament_id)
                            {{route('tournament_page',$item->tournament_id)}}
                            @endisset

                                    ">
                                <div class="nk-widget-stream mt-2 mb-2">
                                    <div class="nk-widget-stream-name">
                                        {{str_limit(strip_tags($item->comment), 50, ' ...')}}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endisset
    </div>
</div>