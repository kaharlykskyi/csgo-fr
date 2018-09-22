@extends('layouts.app')

@section('pageTitle', $pageTitle)

@section('content')

    <!-- START: Breadcrumbs -->
    @component('forum.component.breadcrumb',[
        'parent_nodes' => [(object)['url'=>route('all_chats'),'data'=> 'Chats']],
        'active' => 'Chat with ' . $user->name
    ])

    @endcomponent
    <!-- END: Breadcrumbs -->

    <div class="container">

        <div class="chat-board mb-20">
            @isset($massages)

                @for($item = count($massages)- 1;$item >= 0; $item--)
                    <div class="row @if($massages[$item]->sender == Auth::user()->id){{__('justify-content-end')}}@endif">
                        <div class="col-10">
                            <div class="alert alert-light @if($massages[$item]->sender == Auth::user()->id){{__('text-right')}}@endif" role="alert">
                                {!! $massages[$item]->massage !!}
                                <em>{{$massages[$item]->created_at}}</em><br>
                                @if($massages[$item]->seen == 1)
                                    <svg class="svg-inline--fa fa-eye fa-w-18" aria-hidden="true" data-prefix="fa" data-icon="eye" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M569.354 231.631C512.969 135.949 407.81 72 288 72 168.14 72 63.004 135.994 6.646 231.631a47.999 47.999 0 0 0 0 48.739C63.031 376.051 168.19 440 288 440c119.86 0 224.996-63.994 281.354-159.631a47.997 47.997 0 0 0 0-48.738zM288 392c-75.162 0-136-60.827-136-136 0-75.162 60.826-136 136-136 75.162 0 136 60.826 136 136 0 75.162-60.826 136-136 136zm104-136c0 57.438-46.562 104-104 104s-104-46.562-104-104c0-17.708 4.431-34.379 12.236-48.973l-.001.032c0 23.651 19.173 42.823 42.824 42.823s42.824-19.173 42.824-42.823c0-23.651-19.173-42.824-42.824-42.824l-.032.001C253.621 156.431 270.292 152 288 152c57.438 0 104 46.562 104 104z"></path></svg>
                                @endif
                            </div>
                        </div>
                    </div>
                @endfor

            @endisset
        </div>

        <!-- START: Pagination -->
        @isset($massages)
            {{$massages->links('vendor.pagination.custom')}}
        @endisset
        <!-- END: Pagination -->

        <div class="nk-gap-2"></div>

        <form action="{{route('send_massage',$user->name)}}" method="POST">
            @csrf
            <div class="nk-gap-1"></div>
            <textarea name="massage" cols="30" rows="10" class="nk-summernote form-control"></textarea>
            <div class="nk-gap-1"></div>
            <button type="submit" class="nk-btn nk-btn-rounded nk-btn-color-white">
                <span class="icon ion-paper-airplane"></span>
                {{__('Send Massage')}}
            </button>
        </form>

    </div>

    <div class="nk-gap-2"></div>

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top-5.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->


@endsection