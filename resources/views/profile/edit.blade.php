@extends('layouts.app')

@section('content')

    @component('player_page.component.breadcrumb',['title' => Auth::user()->name])

    @endcomponent

    <div class="nk-gap-3"></div>

    <div class="row">
        <div class="col-12">

            <div class="nk-modal modal" tabindex="100" role="dialog" aria-hidden="false"  style="display: block;position: initial;">
                <div class="modal-dialog modal-sm" role="document" style="margin-top: 20px;margin-bottom: 40px;">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h4 class="mb-0"><span class="text-main-1">Edit</span> Profile</h4>

                            <div class="nk-gap-1"></div>
                            <form action="{{ route('edit_profile') }}" class="nk-form text-white" method="post">
                                <div class="row vertical-gap">
                                    <div class="col-12">
                                        @csrf

                                        <div class="nk-gap"></div>
                                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control {{ $errors->has('name') ? ' nk-error' : '' }}" placeholder="User Name" required>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif

                                        <div class="nk-gap"></div>
                                        <input type="email" name="email" value="{{ Auth::user()->email }}" class=" form-control {{ $errors->has('email') ? ' nk-error' : '' }}" placeholder="Email" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif

                                        <div class="nk-gap"></div>
                                        <select id="flags" name="country_id" class="form-control {{ $errors->has('country_id') ? ' nk-error' : '' }}">
                                            @if(isset($countries))
                                                @foreach($countries as $country)
                                                    <option @if(Auth::user()->country_id == $country->country) selected @endif value="{{$country->country}}" data-class="avatar" data-style="background-image: url({!! asset('images/flag/'.$country->flag) !!});">{{$country->country}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('country_id'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country_id') }}</strong>
                                    </span>
                                        @endif

                                        <div class="nk-gap"></div>
                                        <input type="text" value="{{ Auth::user()->city }}" name="city" class=" form-control {{ $errors->has('city') ? ' nk-error' : '' }}" placeholder="City" required>
                                        @if ($errors->has('city'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif

                                        <div class="nk-gap"></div>
                                        <input type="date" value="{{ Auth::user()->date_birth }}" name="date_birth" class=" form-control {{ $errors->has('date_birth') ? ' nk-error' : '' }}" placeholder="Date of birth" required>
                                        @if ($errors->has('date_birth'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_birth') }}</strong>
                                    </span>
                                        @endif

                                        <div class="nk-gap"></div>
                                        <select name="sex" class="form-control {{  $errors->has('sex') ? ' nk-error' : '' }}">
                                            <option value="male" @if(Auth::user()->sex == 'male') selected @endif >Male</option>
                                            <option value="female" @if(Auth::user()->sex == 'female') selected @endif >Female</option>
                                        </select>
                                        @if ($errors->has('sex'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sex') }}</strong>
                                    </span>
                                        @endif

                                        <div class="nk-gap"></div>
                                        <input type="text" value="{{ Auth::user()->twitch_profile }}" name="twitch_profile" class=" form-control {{ $errors->has('city') ? ' nk-error' : '' }}" placeholder="Twitch profile">
                                        @if ($errors->has('twitch_profile'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('twitch_profile') }}</strong>
                                            </span>
                                        @endif

                                        <div class="nk-gap"></div>
                                        <input type="text" value="{{ Auth::user()->steam_profile }}" name="steam_profile" class=" form-control {{ $errors->has('steam_profile') ? ' nk-error' : '' }}" placeholder="Steam profile">
                                        @if ($errors->has('steam_profile'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('steam_profile') }}</strong>
                                            </span>
                                        @endif

                                        <div class="nk-gap"></div>
                                        <input type="text" value="{{ Auth::user()->faceit_profile }}" name="faceit_profile" class=" form-control {{ $errors->has('faceit_profile') ? ' nk-error' : '' }}" placeholder="Faceit profile">
                                        @if ($errors->has('faceit_profile'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('faceit_profile') }}</strong>
                                            </span>
                                        @endif

                                        <div class="nk-gap"></div>
                                        <input type="text" value="{{ Auth::user()->youtube_profile }}" name="youtube_profile" class=" form-control {{ $errors->has('youtube_profile') ? ' nk-error' : '' }}" placeholder="Youtube profile">
                                        @if ($errors->has('youtube_profile'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('youtube_profile') }}</strong>
                                            </span>
                                        @endif

                                        <div class="nk-gap"></div>
                                        <input type="text" value="{{ Auth::user()->instagram_profile }}" name="instagram_profile" class=" form-control {{ $errors->has('instagram_profile') ? ' nk-error' : '' }}" placeholder="Instagram profile">
                                        @if ($errors->has('instagram_profile'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('instagram_profile') }}</strong>
                                            </span>
                                        @endif

                                        <div class="nk-gap"></div>
                                        <input type="text" value="{{ Auth::user()->twitter_profile }}" name="twitter_profile" class=" form-control {{ $errors->has('twitter_profile') ? ' nk-error' : '' }}" placeholder="Twitter profile">
                                        @if ($errors->has('twitter_profile'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('twitter_profile') }}</strong>
                                            </span>
                                        @endif

                                        <div class="nk-gap"></div>
                                        <textarea class="form-control" name="description" rows="5" placeholder="About myself *">{{Auth::user()->description}}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif

                                        <div class="nk-gap"></div>
                                    </div>
                                </div>

                                <div class="nk-gap-1"></div>
                                <div class="row vertical-gap">
                                    <div class="col-md-6">
                                        <button type="submit" href="#" class="nk-btn nk-btn-rounded nk-btn-color-white nk-btn-block">
                                            {{ __('Save') }}
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

        </div>
    </div>

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top-5.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->

@endsection