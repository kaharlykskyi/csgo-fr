@extends('layouts.app')

@section('content')

    <!-- START: Breadcrumbs -->
    @component('forum.component.breadcrumb',[
        'parent_nodes' => null,
        'active' => 'Forum'
    ])

    @endcomponent
    <!-- END: Breadcrumbs -->
    <div class="container">

        <!-- START: Forums List -->
        <ul class="nk-forum">
            @isset($category)
                @foreach($category as $val)
                    <li>
                        <div class="nk-forum-title">
                            <h3><a href="{{route('topic_page',['id' => $topic->id,'id_category' => $val->id])}}">{{$val->title}}</a></h3>
                        </div>
                        <div class="nk-forum-count">
                            {{\Illuminate\Support\Facades\DB::table('topic_threads')->where(['topic_id' => $topic->id,'id_category' => $val->id])->count()}} threads
                        </div>
                    </li>
                @endforeach
            @endisset
                <li>
                    <div class="nk-forum-title">
                        <h3><a href="{{route('topic_page',['id' => $topic->id,'id_category' => -1])}}">{{__('NO Category')}}</a></h3>
                    </div>
                    <div class="nk-forum-count">
                        {{\Illuminate\Support\Facades\DB::table('topic_threads')->where(['topic_id' => $topic->id,'id_category' => null])->count()}} threads
                    </div>
                </li>
        </ul>
        <!-- END: Forums List -->

    </div>

    <div class="nk-gap-2"></div>

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top-5.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->


@endsection