@extends('layouts.app')

@section('pageTitle', $pageTitle)

@section('content')

    <!-- START: Breadcrumbs -->
    @component('forum.component.breadcrumb',[
        'parent_nodes' => null,
        'active' => 'Chats'
    ])

    @endcomponent
    <!-- END: Breadcrumbs -->

    <div class="container">

        <div class="chat-board mb-20">
            <div class="row">
                @if(isset($chats))
                    @foreach($chats as $chat)
                        <div class="col-12">
                            <?php
                                if (Auth::user()->id != $chat->massage[count($chat->massage) - 1]->sender){
                                    $user = \Illuminate\Support\Facades\DB::table('users')
                                        ->where('id',$chat->massage[count($chat->massage) - 1]->sender)->first();
                                } else {
                                    $user = \Illuminate\Support\Facades\DB::table('users')
                                        ->where('id',$chat->massage[count($chat->massage) - 1]->addressee)->first();
                                }
                            ?>
                            <a href="{{route('send_massage',$user->name)}}" style="text-decoration: none !important;">
                                <div class="alert alert-light" role="alert">
                                    {!! $chat->massage[0]->massage !!}
                                    <em>{{$chat->massage[0]->created_at}} by</em>
                                    <strong class="ml-5">{{$user->name}}</strong><br>
                                    @if($chat->massage[0]->seen == 0)
                                        <strong>Not seen</strong>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info text-center" role="alert">
                        Not Chats!
                    </div>
                @endif
            </div>
        </div>

        <!-- START: Pagination -->
            {{$chats->links('vendor.pagination.custom')}}
        <!-- END: Pagination -->

    </div>

    <div class="nk-gap-2"></div>

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top-5.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->


@endsection