@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'Create stream'])

    @endcomponent

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 m-t-30">
                <div class="card">
                    <div class="card-header">
                        <strong>Create</strong> Stream
                    </div>
                    <div class="card-body card-block">
                        <form action="{{route('admin.streams.update', $stream->id)}}" method="post" class="form-horizontal">
                            @csrf
                            <input type="hidden" name="_method" value="put">

                            @include('admin_area.streams.partrials.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection