@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'Update forum topic'])

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
                        <strong>Update</strong> Topic
                    </div>
                    <div class="card-body card-block">
                        <form action="{{route('admin.forum-topic.update',$forumTopic->id)}}" method="post" class="form-horizontal">
                            <input type="hidden" name="_method" value="put">
                            @csrf

                            @include('admin_area.forum_topic.partrials.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection