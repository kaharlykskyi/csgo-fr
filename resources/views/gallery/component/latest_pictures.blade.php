<h2 class="nk-decorated-h-2 h3"><span><span class="text-main-1">Latest</span> Pictures</span></h2>
<div class="nk-gap"></div>
<div class="nk-popup-gallery">
    <div class="row vertical-gap">
        @isset($latest_img)
            @foreach($latest_img as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="nk-gallery-item-box">
                        <a href="{{asset($item->path)}}" class="nk-gallery-item" data-size="900x572">
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
        @endisset
    </div>
</div>
