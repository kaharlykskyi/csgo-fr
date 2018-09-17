<!-- START: Breadcrumbs -->
<div class="container">
    <ul class="nk-breadcrumbs">


        <li><a href="{{route('home')}}">Home</a></li>


        <li><span class="fa fa-angle-right"></span></li>

        <li><a href="{{route('all_news')}}">All News</a></li>


        @isset($title)
            <li><span class="fa fa-angle-right"></span></li>

            <li><span>{{$title}}</span></li>
        @endisset

    </ul>
</div>
<div class="nk-gap-1"></div>
<!-- END: Breadcrumbs -->