@extends('layouts.app')

@section('content')
<div class="nk-modal modal" tabindex="100" style="display: block;position: initial;">
    <div class="modal-dialog modal-sm" role="document" style="margin-top: 20px;margin-bottom: 40px;">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="mb-0"><span class="text-main-1">Password </span> Reset</h4>
                <div class="nk-gap-1"></div>
                <form action="{{route('password.email')}}" id="resetePassword" class="nk-form text-white" method="post" aria-label="{{ __('Reset Password') }}">
                    @csrf
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row vertical-gap">
                        <div class="col-12">
                            {{ __('Write email. We send password reset link') }}
                            <div class="nk-gap"></div>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' nk-error' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif

                        </div>
                    </div>

                    <div class="nk-gap-1"></div>
                    <div class="row vertical-gap">
                        <div class="col-12">
                            <button type="submit" class="nk-btn nk-btn-rounded nk-btn-color-white nk-btn-block">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>
                </form>
                <script>
                    $("#resetePassword").submit(function (e) {


                        var form = $(this);
                        var url = form.attr('action');

                        $.ajax({
                            type: "POST",
                            url: url,
                            data: form.serialize(), // serializes the form's elements.
                            success: function (data) {
                                location.reload();
                            },
                            error: function (data) {
                                alert(data);
                            }
                        });

                        e.preventDefault(); // avoid to execute the actual submit of the form.
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<!-- START: Page Background -->

<img class="nk-page-background-top" src="{{ asset('images/bg-top.png') }}" alt="">
<img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

<!-- END: Page Background -->
@endsection
