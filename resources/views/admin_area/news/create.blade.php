@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'Create news'])

    @endcomponent

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 m-t-30">
                <div class="card">
                    <div class="card-header">
                        <strong>Create</strong> News
                    </div>
                    <div class="card-body card-block">
                        <form action="{{route('admin.news.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf

                            @include('admin_area.news.partrials.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection