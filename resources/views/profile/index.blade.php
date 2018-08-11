@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            @if(Auth::user()->is_verified === 0)
                <div class="alert alert-warning" role="alert">
                    Please confirm your email.
                    <a href="{{route('send_confirm')}}">Resend.</a>
                </div>
            @elseif(Auth::user()->is_verified === 1)
                <div class="alert alert-info" role="alert">
                    You have been sent a letter. Check your mail.
                    <a href="{{route('send_confirm')}}">No messages?</a>
                </div>
            @endif
        </div>
    </div>

@endsection