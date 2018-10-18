@extends('layouts.app')

@section('content')

    <!-- START: Breadcrumbs -->
    @component('forum.component.breadcrumb',[
        'parent_nodes' => [(object)['url'=>route('forum_topics'),'data'=> 'Forum']],
        'active' => 'Create Thread'
    ])

    @endcomponent
    <!-- END: Breadcrumbs -->

    <div class="container">

        <div class="nk-gap-3"></div>
        <div class="row vertical-gap">
            <div class="col-12">
                <div class="nk-widget">
                    <h4 class="nk-widget-title"><span class="text-main-1">Create Thread</span> Form</h4>
                    <div class="nk-widget-content">
                        <form action="{{route('add_thread')}}" class="nk-form" method="post">
                            @csrf
                            <input type="hidden" name="topic_id" value="{{$topic_id}}">
                            <div class="row vertical-gap sm-gap">
                                <div class="col-12">
                                    <input type="text" value="{{old('title')}}" class="form-control required" name="title" placeholder="Title *" required>
                                    @if ($errors->has('title'))
                                        <small class="form-text text-danger">{{ $errors->first('title') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="nk-gap"></div>
                            <p class="h6 mt-5 mb-1">Description</p>
                            <textarea name="description" cols="30" rows="10" class="nk-summernote form-control" required>{{old('description')}}</textarea>
                            <div class="nk-gap-1"></div>
                            <button class="nk-btn nk-btn-rounded nk-btn-color-white" type="submit">
                                <span>Send</span>
                                <span class="icon"><i class="ion-paper-airplane"></i></span>
                            </button>
                            <div class="nk-form-response-error">
                                @if (session('status'))
                                    {{ session('status') }}
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-gap-3"></div>
    </div>

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top-5.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->

@endsection