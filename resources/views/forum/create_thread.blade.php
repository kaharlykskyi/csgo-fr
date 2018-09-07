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
                            <div class="row vertical-gap sm-gap">
                                <div class="col-12">
                                    <input type="text" value="{{old('title')}}" class="form-control required" name="title" placeholder="Title *" required>
                                    @if ($errors->has('title'))
                                        <small class="form-text text-danger">{{ $errors->first('title') }}</small>
                                    @endif
                                </div>
                                @isset($topics)
                                    <div class="col-12">
                                        <select name="topic_id" class="form-control" required>
                                            <option value="" disabled selected>Select a Topic</option>
                                            @foreach($topics as $topic)
                                                <option value="{{$topic->id}}">{{$topic->title}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('topic_id'))
                                            <small class="form-text text-danger">{{ $errors->first('topic_id') }}</small>
                                        @endif
                                    </div>
                                @endisset
                            </div>
                            <div class="nk-gap"></div>
                            <textarea class="form-control" name="description" rows="5" placeholder="Description *">{{old('title')}}</textarea>
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

@endsection