@extends('layouts.app')

@section('content')
    <!-- START: Register -->
    <div class="nk-modal modal" tabindex="100" role="dialog" aria-hidden="false"  style="display: block;position: initial;">
        <div class="modal-dialog modal-sm" role="document" style="margin-top: 20px;margin-bottom: 40px;">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="mb-0"><span class="text-main-1">Sign</span> Up</h4>

                    <div class="nk-gap-1"></div>
                    <form action="{{ route('register') }}" class="nk-form text-white" method="post">
                        <div class="row vertical-gap">
                            <div class="col-12">
                                @csrf
                                <input type="hidden" name="role" value="user">

                                <div class="nk-gap"></div>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control {{ $errors->has('name') ? ' nk-error' : '' }}" placeholder="User Name" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                                <div class="nk-gap"></div>
                                <input type="email" name="email" value="{{ old('email') }}" class=" form-control {{ $errors->has('email') ? ' nk-error' : '' }}" placeholder="Email" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                                <div class="nk-gap"></div>
                                <select id="flags" name="country_id" class="form-control {{ $errors->has('country_id') ? ' nk-error' : '' }}">
                                    @if(isset($countries))
                                        @foreach($countries as $country)
                                            <option value="{{$country->country}}" data-class="avatar" data-style="background-image: url({!! asset('images/flag/'.$country->flag) !!});">{{$country->country}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('country_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country_id') }}</strong>
                                    </span>
                                @endif


                                <div class="nk-gap"></div>
                                <input type="text" value="{{ old('city') }}" name="city" class=" form-control {{ $errors->has('city') ? ' nk-error' : '' }}" placeholder="City" required>
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif

                                <div class="nk-gap"></div>
                                <input type="date" value="{{ old('date_birth') }}" name="date_birth" class=" form-control {{ $errors->has('date_birth') ? ' nk-error' : '' }}" placeholder="Date of birth" required>
                                @if ($errors->has('date_birth'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_birth') }}</strong>
                                    </span>
                                @endif

                                <div class="nk-gap"></div>
                                <select name="sex" class="form-control {{ $errors->has('sex') ? ' nk-error' : '' }}">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @if ($errors->has('sex'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sex') }}</strong>
                                    </span>
                                @endif

                                <div class="nk-gap"></div>
                                <input type="password" value="" name="password" class="required form-control {{ $errors->has('password') ? ' nk-error' : '' }}" placeholder="Password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                                <div class="nk-gap"></div>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation" required>
                            </div>
                        </div>

                        <div class="nk-gap-1"></div>
                        <div class="row vertical-gap">
                            <div class="col-md-6">
                                <button type="submit" href="#" class="nk-btn nk-btn-rounded nk-btn-color-white nk-btn-block">
                                    {{ __('Sing up') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $( function() {
            $.widget( "custom.iconselectmenu", $.ui.selectmenu, {
                _renderItem: function( ul, item ) {
                    var li = $( "<li>" ),
                        wrapper = $( "<div>", { text: item.label } );

                    if ( item.disabled ) {
                        li.addClass( "ui-state-disabled" );
                    }

                    $( "<span>", {
                        style: item.element.attr( "data-style" ),
                        "class": "ui-icon " + item.element.attr( "data-class" )
                    })
                        .appendTo( wrapper );

                    return li.append( wrapper ).appendTo( ul );
                }
            });

            $( "#flags" )
                .iconselectmenu()
                .iconselectmenu( "menuWidget")
                .addClass( "ui-menu-icons avatar" );
        } );
    </script>

    <!-- END: Register -->

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->

@endsection
