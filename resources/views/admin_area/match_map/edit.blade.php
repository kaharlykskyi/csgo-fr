@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'Update Match Map'])

    @endcomponent

    <div class="container">
        @if (session('status'))
            <div class="alert alert-success m-t-15" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-12 m-t-30">
                <div class="card">
                    <div class="card-header">
                        <strong>Update</strong> Match
                    </div>
                    <div class="card-body card-block">
                        <form action="{{route('admin.match-map.update',$matchMap->id)}}" method="post" class="form-horizontal">
                            @csrf
                            <input type="hidden" name="_method" value="put">

                            @include('admin_area.match_map.partrials.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection