@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning" role="alert">
                {{$report}}<br>
                <a href="{{route('profile')}}">Profile.</a><br>
                <a href="{{route('home')}}">Home.</a>
            </div>
        </div>
    </div>

@endsection