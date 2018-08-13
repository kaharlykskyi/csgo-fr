@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'Edit news'])

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
                        <strong>Create</strong> News
                    </div>
                    <div class="card-body card-block">
                        <form action="{{route('admin.news.update',$news->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <input type="hidden" name="_method" value="put">
                            @csrf

                            @include('admin_area.news.partrials.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection