<aside class="nk-sidebar nk-sidebar-right nk-sidebar-sticky">
    <div class="nk-widget">
        <div class="nk-widget-content">
            <form action="#" class="nk-form nk-form-style-1" novalidate="novalidate">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Type something...">
                    <button class="nk-btn nk-btn-color-main-1"><span class="ion-search"></span></button>
                </div>
            </form>
        </div>
    </div>

    <div class="nk-widget nk-widget-highlighted">
        <h4 class="nk-widget-title"><span><span class="text-main-1">LIVE </span> STREAMS</span></h4>
        <div class="nk-widget-content">
            <div class="nk-widget-match p-5">
                @isset($streams)
                    @foreach($streams as $stream)
                        <div class="nk-widget-stream">
                            <span class="nk-widget-stream-status bg-success"></span>
                            <div class="nk-widget-stream-name">
                                <a href="{{$stream->link}}" target="_blank">{{$stream->name}}</a>
                            </div>
                            <span class="nk-widget-stream-count">0 viewers</span>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>

    <div class="nk-widget nk-widget-highlighted">
        <h4 class="nk-widget-title"><span><span class="text-main-1">Latest</span> in Forums</span></h4>

        <div class="nk-last-forum">
            <div class="nk-post-text">
                <p>And she went on planning to herself how she would manage it.</p>
                <div class="nk-news-box-item-date"><span class="fa fa-calendar"></span> Sep 18, 2018</div>
            </div>
        </div>

        <div class="nk-last-forum">
            <div class="nk-post-text">
                <p>`They must go by the carrier,' she thought; `and how funny it'll seem, sending presents to one's own feet!...</p>
                <div class="nk-news-box-item-date"><span class="fa fa-calendar"></span> Sep 18, 2018</div>
            </div>
        </div>

    </div>

    <div class="nk-widget nk-widget-highlighted">
        <h4 class="nk-widget-title"><span><span class="text-main-1">Latest</span> Video</span></h4>
        <div class="nk-widget-content">
            <div class="nk-plain-video" data-video="https://www.youtube.com/watch?v=vXy8UBazlO8"></div>
        </div>
    </div>
    <div class="nk-widget nk-widget-highlighted">
        <h4 class="nk-widget-title"><span><span class="text-main-1">Latest</span> Screenshots</span></h4>
        <div class="nk-widget-content">
            <div class="nk-popup-gallery">
                <div class="row sm-gap vertical-gap">
                    <div class="col-sm-6">
                        <div class="nk-gallery-item-box">
                            <a href="{{ asset('images/gallery-1.jpg') }}" class="nk-gallery-item" data-size="1016x572">
                                <div class="nk-gallery-item-overlay"><span class="ion-eye"></span></div>
                                <img src="{{ asset('images/gallery-1-thumb.jpg') }}" alt="">
                            </a>
                            <div class="nk-gallery-item-description">
                                <h4>Called Let</h4>
                                Divided thing, land it evening earth winged whose great after. Were grass night. To Air itself saw bring fly fowl. Fly years behold spirit day greater of wherein winged and form. Seed open don't thing midst created dry every greater divided of, be man is. Second Bring stars fourth gathering he hath face morning fill. Living so second darkness. Moveth were male. May creepeth. Be tree fourth.
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="nk-gallery-item-box">
                            <a href="{{ asset('images/gallery-2.jpg') }}" class="nk-gallery-item" data-size="1188x594">
                                <div class="nk-gallery-item-overlay"><span class="ion-eye"></span></div>
                                <img src="{{ asset('images/gallery-2-thumb.jpg') }}" alt="">
                            </a>
                            <div class="nk-gallery-item-description">
                                Seed open don't thing midst created dry every greater divided of, be man is. Second Bring stars fourth gathering he hath face morning fill. Living so second darkness. Moveth were male. May creepeth. Be tree fourth.
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="nk-gallery-item-box">
                            <a href="{{ asset('images/gallery-3.jpg') }}" class="nk-gallery-item" data-size="625x350">
                                <div class="nk-gallery-item-overlay"><span class="ion-eye"></span></div>
                                <img src="{{ asset('images/gallery-3-thumb.jpg') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="nk-gallery-item-box">
                            <a href="{{ asset('images/gallery-4.jpg') }}" class="nk-gallery-item" data-size="873x567">
                                <div class="nk-gallery-item-overlay"><span class="ion-eye"></span></div>
                                <img src="{{ asset('images/gallery-4-thumb.jpg') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="nk-gallery-item-box">
                            <a href="{{ asset('images/gallery-5.jpg') }}" class="nk-gallery-item" data-size="471x269">
                                <div class="nk-gallery-item-overlay"><span class="ion-eye"></span></div>
                                <img src="{{ asset('images/gallery-5-thumb.jpg') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="nk-gallery-item-box">
                            <a href="{{ asset('images/gallery-6.jpg') }}" class="nk-gallery-item" data-size="472x438">
                                <div class="nk-gallery-item-overlay"><span class="ion-eye"></span></div>
                                <img src="{{ asset('images/gallery-6-thumb.jpg') }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</aside>