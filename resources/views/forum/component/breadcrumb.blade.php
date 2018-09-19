<div class="container">
    <ul class="nk-breadcrumbs">


        <li><a href="{{route('home')}}">Home</a></li>


        @isset($parent_nodes)
            @foreach($parent_nodes as $node)
                <li><span class="fa fa-angle-right"></span></li>

                <li><a href="{{$node->url}}">@if(isset($node->data->title)){{$node->data->title}}@else{{$node->data}}@endif</a></li>
            @endforeach
        @endisset


        <li><span class="fa fa-angle-right"></span></li>

        <li><span>{{$active}}</span></li>

    </ul>
</div>
<div class="nk-gap-1"></div>