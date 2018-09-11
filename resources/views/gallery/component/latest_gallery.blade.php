<div class="nk-gap-2"></div>
<h2 class="nk-decorated-h-2 h3"><span><span class="text-main-1">Recent</span> Galleries</span></h2>
<div class="nk-gap"></div>
<div class="row vertical-gap">
    @isset($latest_gallery)
        @foreach($latest_gallery as $item)
            <div class="col-md-6">
                <div class="nk-gallery-item-group">
                    <a href="{{route('gallery_page',str_replace(' ','_',$item->name))}}" class="nk-gallery-item">
                        <div class="nk-gallery-item-overlay"><span class="ion-eye"></span></div>
                        <img src="@if(isset($item->logo)){{asset($item->logo)}}@else{{asset('images/photo_not_available.png')}}@endif" alt="">
                    </a>
                    <div class="nk-gallery-item-description">
                        <h4 class="nk-gallery-item-description-title h5">{{$item->name}}</h4>
                        <div class="nk-gallery-item-description-info">
                            <span class="far fa-image"></span>
                            <span>
                                {{\Illuminate\Support\Facades\DB::table('images')->where('gallery_id',$item->id)->count()}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endisset
</div>