@extends('layouts.app')

@section('pageTitle', $pageTitle)

@section('content')

    @component('player_page.component.breadcrumb',['title' => Auth::user()->name])

    @endcomponent

    @if (session('status'))
        <div class="alert alert-info" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            @if(Auth::user()->is_verified === 0)
                <div class="alert alert-warning" role="alert">
                    We have sent the confirmation letter to your e-mail.
                    <a href="{{route('send_confirm')}}">Resend.</a>
                </div>
            @elseif(Auth::user()->is_verified === 1)
                <div class="alert alert-info" role="alert">
                    We have sent the confirmation letter to your e-mail.
                    <a href="{{route('send_confirm')}}">No messages?</a>
                </div>
            @endif

        </div>
    </div>

    <div class="nk-gap-3"></div>

    <div class="row">
        <div class="col-lg-8">
            <!-- START: Teammate Card -->
            <div class="nk-teammate-card">
                <div class="nk-teammate-card-photo">
                    <img src="@if(isset(Auth::user()->logo_user)){{asset('assets/images/user_avatar/' . Auth::user()->logo_user)}}@else{{asset('images/photo_not_available.png')}}@endif" alt="Faker">
                </div>

                <div class="nk-teammate-card-info" style="overflow: auto;">
                    <table>
                        <tbody>
                            <tr>
                                <td class="p-10">
                                    <em>name</em>
                                    <div class="text-white">{{Auth::user()->name}}</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-10">
                                    <em>email</em>
                                    <div  class="text-white">{{Auth::user()->email}}</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-10">
                                    <em>country</em>
                                    <div  class="text-white">{{Auth::user()->country_id}}</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-10">
                                    <em>city</em>
                                    @isset(Auth::user()->city)
                                        <div  class="text-white">{{Auth::user()->city}}</div>
                                    @endisset
                                </td>
                            </tr>
                            <tr>
                                <td class="p-10">
                                    <em>birthday</em>
                                    <div  class="text-white">{{date('M d Y',strtotime(Auth::user()->date_birth))}}</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-10">
                                    <em>sex</em>
                                    <div  class="text-white">{{Auth::user()->sex}}</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-l-0">
                                    <div class="col-12 p-0">
                                        <p class="h5">Social Profiles</p>
                                        <div class="">
                                            @isset(Auth::user()->twitch_profile)
                                                <p>
                                                    <em>twitch profile</em><br>
                                                    <a href="{{Auth::user()->twitch_profile}}">{{Auth::user()->twitch_profile}}</a>
                                                </p>
                                            @endisset
                                            @isset(Auth::user()->steam_profile)
                                                <p>
                                                    <em>steam profile</em><br>
                                                    <a href="{{Auth::user()->twitch_profile}}">{{Auth::user()->steam_profile}}</a>
                                                </p>
                                            @endisset
                                            @isset(Auth::user()->faceit_profile)
                                                <p>
                                                    <em>faceit profile</em><br>
                                                    <a href="{{Auth::user()->twitch_profile}}">{{Auth::user()->faceit_profile}}</a>
                                                </p>
                                            @endisset
                                                @isset(Auth::user()->youtube_profile)
                                                    <p>
                                                        <em>youtube profile</em><br>
                                                        <a href="{{Auth::user()->twitch_profile}}">{{Auth::user()->youtube_profile}}</a>
                                                    </p>
                                                @endisset
                                                @isset(Auth::user()->instagram_profile)
                                                    <p>
                                                        <em>instagram profile</em><br>
                                                        <a href="{{Auth::user()->twitch_profile}}">{{Auth::user()->instagram_profile}}</a>
                                                    </p>
                                                @endisset
                                                @isset(Auth::user()->twitter_profile)
                                                    <p>
                                                        <em>twitter profile</em><br>
                                                        <a href="{{Auth::user()->twitch_profile}}">{{Auth::user()->twitter_profile}}</a>
                                                    </p>
                                                @endisset
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-10">
                                    <em>description</em>
                                    <div  class="text-white">{{Auth::user()->description}}</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-10">
                                    <em>account created</em>
                                    <div  class="text-white">{{date('M d Y',strtotime(Auth::user()->created_at))}}</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END: Teammate Card -->
            <div class="row mt-15">
                <div class="col-12 mb-20">
                    <div class="profile-button">
                        <a href="#" id="upload_avatar" onclick="$('.upload_input').fadeToggle(); return false;" class="nk-btn nk-btn-rounded nk-btn-color-dark-3 nk-btn-hover-color-success">
                            {{ __('Upload photo') }}
                        </a>
                        @isset(Auth::user()->logo_user)
                            <a href="{{route('delete_avatar',['avatar' => Auth::user()->logo_user])}}" onclick="if(confirm('DELETE?')){return true}else{return false}" class="nk-btn nk-btn-rounded nk-btn-color-dark-3 nk-btn-hover-color-danger ml-15">
                                {{ __('Delete photo') }}
                            </a>
                        @endisset
                    </div>
                    <div class="upload_input">
                        <div class="nk-gap-2"></div>
                        <form action="{{route('upload_avatar')}}" method="post" enctype="multipart/form-data" class="nk-form" >
                            @csrf
                            <div class="row vertical-gap sm-gap">
                                <div class="col-md-12">
                                    <input type="file" class="form-control required" name="logo_user" placeholder="">
                                </div>
                            </div>
                            <div class="nk-gap"></div>
                            <button type="submit" class="nk-btn nk-btn-rounded nk-btn-color-dark-3">
                                <span>Send</span>
                                <span class="icon"><i class="ion-paper-airplane"></i></span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-12 mb-20">
                    <div class="profile-button justify-content-end">
                        <a href="{{route('change_password')}}" class="nk-btn nk-btn-outline nk-btn-color-primary mr-10">{{__('Change Password')}}</a>

                        <a href="{{route('edit_profile')}}" class="nk-btn nk-btn-outline nk-btn-color-warning">
                            {{ __('Edit Info') }}
                        </a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="ml-10 nk-btn nk-btn-outline nk-btn-color-danger">
                            {{ __('Logout') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row p-0">
                <div class="col-12 col-md-6 col-lg-12">
                    @isset($last_forum)
                        <div class="nk-widget nk-widget-highlighted">
                            <h4 class="nk-widget-title"><span><span class="text-main-1">Latest</span> in Forums</span></h4>
                            <div class="nk-widget-content">
                                @foreach($last_forum as $item)
                                    <div class="nk-widget-match p-5">
                                        <a href="{{route('thread_page',['id' => $item->id_topic, 'thread_id' => $item->id_thread])}}">
                                            <div class="nk-widget-stream mt-2 mb-2">
                                                <div class="nk-widget-stream-name">
                                                    {{str_limit(strip_tags($item->text_post), 50, ' ...')}}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endisset
                </div>
                <div class="col-12 col-md-6 col-lg-12 mt-20">
                    @isset($comments)
                        <div class="nk-widget nk-widget-highlighted">
                            <h4 class="nk-widget-title"><span><span class="text-main-1">Latest</span> Comments</span></h4>
                            <div class="nk-widget-content">
                                @foreach($comments as $item)
                                    <div class="nk-widget-match p-5">
                                        <a href="
                                            @isset($item->match_id)
                                                {{route('match_page',$item->match_id)}}
                                            @endisset
                                            @isset($item->news_id)
                                                {{route('news_page',$item->news_id)}}
                                            @endisset
                                            @isset($item->tournament_id)
                                                {{route('tournament_page',$item->tournament_id)}}
                                            @endisset

                                                ">
                                            <div class="nk-widget-stream mt-2 mb-2">
                                                <div class="nk-widget-stream-name">
                                                    {{str_limit(strip_tags($item->comment), 50, ' ...')}}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top-5.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->

@endsection