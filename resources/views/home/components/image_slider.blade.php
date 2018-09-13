<div class="nk-image-slider" data-autoplay="8000">
    @isset($banner)
        @foreach($banner as $item)
            <div class="nk-image-slider-item">
                <img src="{{ asset($item->img) }}" alt="@isset($item->title){{$item->title}}@endisset" class="nk-image-slider-img" data-thumb="{{ asset($item->img) }}">
            </div>
        @endforeach
    @endisset
</div>