@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'Edit Video'])

    @endcomponent

    <div class="container">
        <div class="row justify-content-center">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-12 m-t-30">
                <div class="card">
                    <div class="card-header">
                        <strong>Edit</strong> Video
                    </div>
                    <div class="card-body card-block">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert warning">
                                    <p class="h6">Don`t add both!!!</p>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link @isset($video->code){{__('active')}}@endisset" id="home-tab" data-toggle="tab" href="#code" role="tab" aria-controls="home" aria-selected="true">Add Link</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @isset($video->path){{__('active')}}@endisset" id="profile-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="profile" aria-selected="false">Upload video</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade @isset($video->code){{__('show active')}}@endisset" id="code" role="tabpanel" aria-labelledby="home-tab">
                                <form action="{{route('admin.video.update',$video->id)}}" method="post" class="form-horizontal">
                                    <input type="hidden" name="_method" value="put">
                                    @csrf

                                    @include('admin_area.video.partrials.form_link')
                                </form>
                            </div>
                            <div class="tab-pane fade @isset($video->path){{__('show active')}}@endisset" id="upload" role="tabpanel" aria-labelledby="profile-tab">
                                <form action="{{route('admin.video.update',$video->id)}}" method="post" class="form-horizontal">
                                    <input type="hidden" name="_method" value="put">
                                    @csrf

                                    @include('admin_area.video.partrials.form_upload')
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection