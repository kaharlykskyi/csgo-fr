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
            <div class="row vertical-gap text-white">
                @if(isset($users))
                    @foreach($users as $user)
                        <div class="col-lg-12">
                            <a href="{{route('send_massage',$user->name)}}" style="text-decoration: none !important;">
                                <div class="nk-box-2 bg-dark-2 p-5 pl-15">
                                    Chat with
                                    <h4 class="m-0">{{$user->name}}</h4>
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
            {{$users->links('vendor.pagination.custom')}}
        <!-- END: Pagination -->

    </div>

    <div class="nk-gap-2"></div>

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top-5.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->


@endsection