<div class="nk-gap-2"></div>
<div class="row">
    <div class="col-md-6 d-sm-none d-none d-md-block d-lg-block d-xl-block">
        <h5 class="nk-decorated-h-2"><span><span class="text-main-1">Latest</span> News</span></h5>
    </div>
    <div class="col-md-6 d-sm-none d-none d-md-block d-lg-block d-xl-block">
        <h5 class="nk-decorated-h-2"><span><span class="text-main-1">Latest</span> Competitions</span></h5>
    </div>
</div>


<div class="nk-news-box row">
    <div class="col-md-6 mt-15 d-xl-none d-lg-none d-md-none">
        <h4 class="nk-decorated-h-2"><span><span class="text-main-1">Latest</span> News</span></h4>
    </div>
    <div class="nk-news-box-list col-md-6 pl-0">
        <div class="nano">
            <div class="nano-content">

                @forelse($latest_news as $latest_new)

                    <a href="{{route('news_page',$latest_new->id)}}">
                        <div class="nk-news-box-item">
                            <div class="nk-news-box-item-img">
                                @foreach($countrys as $country)
                                    @if($country->country == $latest_new->country_id)
                                        <img class="mr-3 flag" src="{{ asset('images/flag/' . $country->flag) }}" alt="{{$latest_new->title}}">
                                    @endif
                                @endforeach
                            </div>
                            <div class="nk-news-box-item-title-wrapper">
                                <h6 class="nk-news-box-item-title title-latest-home">{{str_limit($latest_new->title, 20, ' ...')}}</h6>
                                <div class="nk-news-box-item-title-comment-wrapper">
                                    <span class="fa fa-comments"></span>
                                    <a href="#">
                                        {{\Illuminate\Support\Facades\DB::table('news_comments')->where('news_id',$latest_new->id)->count()}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>

                @empty
                @endforelse

            </div>
        </div>
    </div>
    <div class="col-md-6 mt-15 d-xl-none d-lg-none d-md-none">
        <h4 class="nk-decorated-h-2"><span><span class="text-main-1">Latest</span> Competitions</span></h4>
    </div>
    <div class="nk-news-box-list col-md-6 pl-0">
        <div class="nano">
            <div class="nano-content">

                @forelse($latest_turnaments as $latest_turnament)

                    <a href="{{route('tournament_page',$latest_turnament->id)}}">
                        <div class="nk-news-box-item">
                            <div class="nk-news-box-item-img">
                                @foreach($countrys as $country)
                                    @if($country->country == $latest_turnament->country_id)
                                        <img class="mr-3 flag" src="{{ asset('images/flag/' . $country->flag) }}" alt="{{$latest_turnament->title}}">
                                    @endif
                                @endforeach
                            </div>
                            <div class="nk-news-box-item-title-wrapper">
                                <h6 class="nk-news-box-item-title title-latest-home">{{str_limit($latest_turnament->title, 20, ' ...')}}</h6>
                                <div class="nk-news-box-item-title-comment-wrapper">
                                    <span class="fa fa-comments"></span>
                                    <a href="#">
                                        {{\Illuminate\Support\Facades\DB::table('tournament_comments')->where('tournament_id',$latest_turnament->id)->count()}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </a>

                @empty
                @endforelse

            </div>
        </div>
    </div>
</div>

<div class="nk-gap-2"></div>

