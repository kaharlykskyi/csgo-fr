<!-- START: Video Galleries-->
<div class="nk-gap-2"></div>
<h2 class="nk-decorated-h-2 h3"><span><span class="text-main-1">Video</span> Galleries</span></h2>
<div class="nk-gap"></div>
<div class="row vertical-gap">
    @isset($video)
        @foreach($video as $item)
            <div class="col-md-6">
                <h4>{{$item->title}}</h4>
                @if(isset($item->code))
                    @if(stripos($item->code,'twitch.tv') !==false )
                        <?php $id_vodeo = explode('/',$item->code); ?>
                        <div class="responsive-embed responsive-embed-16x9">
                            <iframe src="https://player.twitch.tv/?autoplay=false&video=v{{end($id_vodeo)}}" frameborder="0" allowfullscreen="true" scrolling="no"></iframe>
                        </div>
                    @elseif(stripos($item->code,'youtu.be') !==false)
                        <div class="nk-plain-video" data-video="{{$item->code}}"></div>
                    @endif
                @else
                    <video controls class="nk-plain-video" @isset($item->logo) poster="{{asset($item->logo)}}"@endisset style="padding-top: 0">
                        <source src="{{asset($item->path)}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            </div>
        @endforeach
    @endisset
</div>
<!-- END: Video Galleries -->