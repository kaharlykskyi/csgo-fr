<div class="nk-image-slider" data-autoplay="800000">
    @isset($banner)
        @foreach($banner as $item)
            <div class="nk-image-slider-item">
                <img src="{{ asset($item->img) }}" alt="@isset($item->title){{$item->title}}@endisset" class="nk-image-slider-img" data-thumb="{{ asset($item->img) }}">
                @isset($item->link) data-link=""
                    <div class="nk-image-slider-content">
                        <a href="{{$item->link}}" class="nk-btn nk-btn-rounded nk-btn-color-white nk-btn-hover-color-main-1">Read More</a>
                    </div>
                @endisset
            </div>
        @endforeach
    @endisset
</div>