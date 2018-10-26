@extends('layouts.app')

@section('content')
    <div class="nk-fullscreen-block-middle">
        <div class="container text-center">
            <h1 class="nk-decorated-h-2 h3"><span><span class="text-main-1">Stream </span> {{$name}}</span></h1>
            <div class="nk-gap-2"></div>

            <div class="row">
                <div class="col-12">
                    <div class="responsive-embed responsive-embed-16x9">
                        @if($service === 'twitch')
                            <iframe src="https://player.twitch.tv/?channel={{$name}}&autoplay=true" frameborder="0" allowfullscreen="true" scrolling="no" height="500"></iframe>
                        @elseif($service === 'youtube')
                            <iframe height="500" src="https://www.youtube.com/embed/{{$id}}?autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                        @elseif($service === 'facebook')
                            @php
                                $link = \Illuminate\Support\Facades\DB::table('streams')->where('id',$id)->first();
                            @endphp
                            <iframe src="https://www.facebook.com/plugins/video.php?href={{$link->link}}" height="350" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>
                        @endif
                    </div>
                </div>
            </div>
            <div class="nk-gap-3"></div>
        </div>
    </div>
    <div class="nk-fullscreen-block-bottom">
        <div class="nk-gap-2"></div>
        <ul class="nk-social-links-2 nk-social-links-center">
            <li><a class="nk-social-rss" href="#"><span class="fa fa-rss"></span></a></li>
            <li><a class="nk-social-twitch" href="#"><span class="fab fa-twitch"></span></a></li>
            <li><a class="nk-social-steam" href="#"><span class="fab fa-steam"></span></a></li>
            <li><a class="nk-social-facebook" href="#"><span class="fab fa-facebook"></span></a></li>
            <li><a class="nk-social-google-plus" href="#"><span class="fab fa-google-plus"></span></a></li>
            <li><a class="nk-social-twitter" href="https://twitter.com/nkdevv" target="_blank"><span class="fab fa-twitter"></span></a></li>
            <li><a class="nk-social-pinterest" href="#"><span class="fab fa-pinterest-p"></span></a></li>
        </ul>
        <div class="nk-gap-2"></div>
    </div>

    <!-- START: Page Background -->

    <div class="nk-page-background-fixed" style="background-image: url({{ asset('images/bg-fixed-1.jpg')}})"></div>

    <!-- END: Page Background -->

@endsection