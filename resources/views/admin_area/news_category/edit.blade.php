@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'Edit news category'])

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
                        <strong>Edit</strong> News Category
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{route('admin.news-category.create')}}" class="btn btn-primary btn-sm">Add more</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{route('admin.news-category.update',$newsCategory->id)}}" method="post" class="form-horizontal">
                            <input type="hidden" name="_method" value="put">
                            @csrf

                            @include('admin_area.news_category.partrials.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection