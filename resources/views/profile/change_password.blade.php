@extends('layouts.app')

@section('content')

    @if (session('status'))
        <div class="alert alert-danger" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="nk-modal modal" tabindex="100" role="dialog" aria-hidden="false"  style="display: block;position: initial;">
        <div class="modal-dialog modal-sm" role="document" style="margin-top: 20px;margin-bottom: 40px;">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="mb-0"><span class="text-main-1">Change</span> Password</h4>

                    <div class="nk-gap-1"></div>
                    <form action="{{ route('change_password') }}" class="nk-form text-white" method="post">
                        <div class="row vertical-gap">
                            <div class="col-12">
                                @csrf

                                <input type="password" value="" name="password" class="required form-control {{ $errors->has('password') ? ' nk-error' : '' }}" placeholder="Old Password" required>

                                <div class="nk-gap"></div>

                                <input type="password" value="" name="new_password" class="required form-control {{ $errors->has('new_password') ? ' nk-error' : '' }}" placeholder="New Password" required>
                                @if ($errors->has('new_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif

                                <div class="nk-gap"></div>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="New Password Confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="nk-gap-1"></div>
                        <div class="row vertical-gap">
                            <div class="col-md-6">
                                <button type="submit" href="#" class="nk-btn nk-btn-rounded nk-btn-color-white nk-btn-block">
                                    {{ __('Change') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- END: Register -->

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->

@endsection
