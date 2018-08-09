@extends('layouts.app')

@section('content')
<div class="nk-modal modal" tabindex="100" style="display: block;position: initial;">
    <div class="modal-dialog modal-sm" role="document" style="margin-top: 20px;margin-bottom: 40px;">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="mb-0"><span class="text-main-1">Reset </span> Password</h4>
                <div class="nk-gap-1"></div>
                <form action="{{route('password.request')}}" class="nk-form text-white" method="post" aria-label="{{ __('Reset Password') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="row vertical-gap">
                        <div class="col-12">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' nk-error' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="Email"  required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif

                            <div class="nk-gap"></div>

                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' nk-error' : '' }}" placeholder="Password"  name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif

                            <div class="nk-gap"></div>

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation"  required>

                        </div>
                    </div>

                    <div class="nk-gap-1"></div>
                    <div class="row vertical-gap">
                        <div class="col-12">
                            <button type="submit" class="nk-btn nk-btn-rounded nk-btn-color-white nk-btn-block">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- START: Page Background -->

<img class="nk-page-background-top" src="{{ asset('images/bg-top.png') }}" alt="">
<img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

<!-- END: Page Background -->
@endsection
