<div class="nk-gap-3"></div>
<h3 class="nk-decorated-h-2"><span><span class="text-main-1">Tabbed</span> News</span></h3>
<div class="nk-gap"></div>
<div class="nk-tabs">
    <!--
        Additional Classes:
            .nav-tabs-fill
    -->
    <ul class="nav nav-tabs nav-tabs-fill" role="tablist">
        @isset($news_tabbed)
            @foreach($news_tabbed as $k => $val)
                <li class="nav-item">
                    <a class="nav-link @if($k == 0){{__('active')}}@endif" href="#tabs-1-{{$k}}" role="tab" data-toggle="tab">{{$val->category}}</a>
                </li>
            @endforeach
        @endisset
    </ul>
    <div class="tab-content">
        @isset($news_tabbed)
            @foreach($news_tabbed as $k => $val)
                <div role="tabpanel" class="tab-pane fade @if($k == 0){{__('show active')}}@endif" id="tabs-1-{{$k}}">
                    <div class="nk-gap"></div>
                    <!-- START: Tab -->

                    @foreach($val->news as $k => $news)
                        @if($k == 0)
                            <div class="nk-blog-post nk-blog-post-border-bottom">
                                <a href="{{route('news_page',$news->id)}}" class="nk-post-img">
                                    <img src="{{ asset('assets/images/news_img/' . $news->banner_image) }}" alt="{{$news->title}}">

                                    <span class="nk-post-categories">
                                    <span class="bg-main-1">{{$val->category}}</span>
                                </span>

                                </a>
                                <div class="nk-gap-1"></div>
                                <h2 class="nk-post-title h4"><a href="{{route('news_page',$news->id)}}">{{$news->title}}</a></h2>
                                <div class="nk-post-date mt-10 mb-10">
                                    <span class="fa fa-calendar"></span> {{$news->publication_date}}
                                    <span class="fa fa-comments"></span> <a href="#">
                                        {{\Illuminate\Support\Facades\DB::table('news_comments')->where('news_id',$news->id)->count()}} comments</a>
                                </div>
                                <div class="nk-post-text">
                                    <p>
                                        {!! str_limit(preg_replace("/<img[^>]+\>/i",'',$news->content_news), 100, ' ...') !!}
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="nk-blog-post nk-blog-post-border-bottom">
                                <div class="row vertical-gap">
                                    <div class="col-lg-3 col-md-5">
                                        <a href="{{route('news_page',$news->id)}}" class="nk-post-img">
                                            <img src="{{ asset('assets/images/news_img/' . $news->banner_image) }}" alt="{{$news->title}}">

                                            <span class="nk-post-categories">
                                                <span class="bg-main-1">{{$val->category}}</span>
                                            </span>

                                        </a>
                                    </div>
                                    <div class="col-lg-9 col-md-7">
                                        <h2 class="nk-post-title h4"><a href="{{route('news_page',$news->id)}}">At length one of them called out in a clear</a></h2>
                                        <div class="nk-post-date mt-10 mb-10">
                                            <span class="fa fa-calendar"></span> {{$news->publication_date}}
                                            <span class="fa fa-comments"></span> <a href="#">
                                                {{\Illuminate\Support\Facades\DB::table('news_comments')->where('news_id',$news->id)->count()}} comments
                                            </a>
                                        </div>
                                        <div class="nk-post-text">
                                            <div>
                                                {!! str_limit(preg_replace("/<img[^>]+\>/i",'',$news->content_news), 70, ' ...') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <!-- END: Tab -->
                    <div class="nk-gap"></div>
                </div>
            @endforeach
        @endisset
    </div>
</div>