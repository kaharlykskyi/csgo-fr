<div class="nk-modal modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="ion-android-close"></span>
                </button>

                <h4 class="mb-0"><span class="text-main-1">Sign</span> In</h4>

                <div class="nk-gap-1"></div>
                <form action="{{route('login')}}" id="loginFrom" class="nk-form text-white" method="post">
                    @csrf
                    <div class="row vertical-gap">
                        <div class="col-12">
                            Use email and password:

                            <div class="nk-gap"></div>
                            <input type="email" value="" name="email" class=" form-control" placeholder="Email" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif

                            <div class="nk-gap"></div>
                            <input type="password" value="" name="password" class="required form-control" placeholder="Password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="nk-gap-1"></div>
                    <div class="row vertical-gap">
                        <div class="col-md-6">
                            <button type="submit" class="nk-btn nk-btn-rounded nk-btn-color-white nk-btn-block">Sign In</button>
                        </div>
                        <div class="col-md-6">
                            <div class="mnt-5">
                                <small><a href="{{route('password.request')}}">Forgot your password?</a></small>
                            </div>
                            <div class="mnt-5">
                                <small><a href="{{route('register')}}">Not a member? Sign up</a></small>
                            </div>
                        </div>
                    </div>
                </form>

                <script>
                    $("#loginFrom").submit(function (e) {


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