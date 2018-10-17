@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'Update forum category'])

    @endcomponent

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 m-t-30">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <strong>Update</strong> Category
                    </div>
                    <div class="card-body card-block">
                        <form action="{{route('admin.forum-category.update',$forumCategory->id)}}" method="post" class="form-horizontal">
                            <input type="hidden" name="_method" value="put">
                            @csrf

                            @include('admin_area.forum_category.partrials.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection