<div class="nk-gap-2"></div>
<div class="row">
    <div class="col-md-6 d-sm-none d-none d-md-block d-lg-block d-xl-block">
        <h3 class="nk-decorated-h-2"><span><span class="text-main-1">Latest</span> News</span></h3>
    </div>
    <div class="col-md-6 d-sm-none d-none d-md-block d-lg-block d-xl-block">
        <h3 class="nk-decorated-h-2"><span><span class="text-main-1">Latest</span> Competitions</span></h3>
    </div>
</div>
<div class="nk-gap"></div>

<div class="nk-news-box row">
    <div class="col-md-6 mt-15 d-xl-none d-lg-none d-md-none">
        <h3 class="nk-decorated-h-2"><span><span class="text-main-1">Latest</span> News</span></h3>
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
                                        <img class="mr-3" src="{{ asset('images/flag/' . $country->flag) }}" alt="{{$latest_new->title}}">
                                    @endif
                                @endforeach
                            </div>
                            <h3 class="nk-news-box-item-title">{{$latest_new->short_title}}</h3>
                        </div>
                    </a>

                @empty
                @endforelse

            </div>
        </div>
    </div>
    <div class="col-md-6 mt-15 d-xl-none d-lg-none d-md-none">
        <h3 class="nk-decorated-h-2"><span><span class="text-main-1">Latest</span> Competitions</span></h3>
    </div>
    <div class="nk-news-box-list col-md-6 pl-0">
        <div class="nano">
            <div class="nano-content">

                @forelse($latest_turnaments as $latest_turnament)

                    <div class="nk-news-box-item">
                        <div class="nk-news-box-item-img">
                            <img src="https://www.vakarm.net/uploads/images/coverages/mini_icones/d6e7ad95a3fb5d13d3ac1b277590bb265993d995.jpg" alt="{{$latest_turnament->title}}">
                        </div>
                        <div class="nk-news-box-item-img">
                            @foreach($countrys as $country)
                                @if($country->country == $latest_turnament->country_id)
                                    <img class="mr-3" src="{{ asset('images/flag/' . $country->flag) }}" alt="{{$latest_turnament->title}}">
                                @endif
                            @endforeach
                        </div>
                        <h3 class="nk-news-box-item-title">{{$latest_turnament->short_title}}</h3>
                    </div>

                @empty
                @endforelse

            </div>
        </div>
    </div>
</div>

<div class="nk-gap-2"></div>

