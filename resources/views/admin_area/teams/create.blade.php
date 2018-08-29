@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'Create team'])

    @endcomponent

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 m-t-30">
                <div class="card">
                    <div class="card-header">
                        <strong>Create</strong> Team
                    </div>
                    <div class="card-body card-block">
                        <form action="{{route('admin.teams.store')}}" method="post" class="form-horizontal">
                            @csrf

                            @include('admin_area.teams.partrials.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection