@extends('layouts.app')

@section('pageTitle', $pageTitle)

@section('content')

    @component('player_page.component.breadcrumb',['title' => $user->name])

    @endcomponent


    <div class="nk-gap-3"></div>

    <div class="row">
        <div class="col-12 mb-20">
            <a href="{{route('send_massage',$user->name)}}" class="nk-btn nk-btn-rounded nk-btn-color-success nk-btn-hover-color-info">
                <span class="icon ion-paper-airplane"></span>
                {{__('Send Massage')}}
            </a>
        </div>
        <div class="col-12">
            <!-- START: Teammate Card -->
            <div class="nk-teammate-card">
                <div class="nk-teammate-card-photo">
                    <img src="@if(isset($user->logo_user)){{asset('assets/images/user_avatar/' . $user->logo_user)}}@else{{asset('images/photo_not_available.png')}}@endif" alt="Faker">
                </div>

                <div class="nk-teammate-card-info">
                    <table>
                        <tbody>
                        <tr>
                            <td class="p-10">
                                <em>name</em>
                                <div class="text-white">{{$user->name}}</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-10">
                                <em>email</em>
                                <div  class="text-white">{{$user->email}}</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-10">
                                <em>country</em>
                                <div  class="text-white">{{$user->country_id}}</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-10">
                                <em>city</em>
                                @isset(Auth::user()->city)
                                    <div  class="text-white">{{$user->city}}</div>
                                @endisset
                            </td>
                        </tr>
                        <tr>
                            <td class="p-10">
                                <em>birthday</em>
                                <div  class="text-white">{{date('M d Y',strtotime($user->date_birth))}}</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-10">
                                <em>sex</em>
                                <div  class="text-white">{{$user->sex}}</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-10">
                                <em>about myself</em>
                                <div  class="text-white">{{$user->description}}</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="row p-l-0">
                                <div class="col-12 p-0">
                                    <p class="h5">Social Profiles</p>
                                    <div class="">
                                        @isset($user->twitch_profile)
                                            <p>
                                                <em>twitch profile</em><br>
                                                <a href="{{$user->twitch_profile}}">{{$user->twitch_profile}}</a>
                                            </p>
                                        @endisset
                                        @isset($user->steam_profile)
                                            <p>
                                                <em>steam profile</em><br>
                                                <a href="{{$user->twitch_profile}}">{{$user->steam_profile}}</a>
                                            </p>
                                        @endisset
                                        @isset($user->faceit_profile)
                                            <p>
                                                <em>faceit profile</em><br>
                                                <a href="{{$user->twitch_profile}}">{{$user->faceit_profile}}</a>
                                            </p>
                                        @endisset
                                        @isset($user->youtube_profile)
                                            <p>
                                                <em>youtube profile</em><br>
                                                <a href="{{$user->twitch_profile}}">{{$user->youtube_profile}}</a>
                                            </p>
                                        @endisset
                                        @isset($user->instagram_profile)
                                            <p>
                                                <em>instagram profile</em><br>
                                                <a href="{{$user->twitch_profile}}">{{$user->instagram_profile}}</a>
                                            </p>
                                        @endisset
                                        @isset($user->twitter_profile)
                                            <p>
                                                <em>twitter profile</em><br>
                                                <a href="{{$user->twitch_profile}}">{{$user->twitter_profile}}</a>
                                            </p>
                                        @endisset
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-10">
                                <em>create account</em>
                                <div  class="text-white">{{date('M d Y',strtotime($user->created_at))}}</div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END: Teammate Card -->
        </div>
    </div>

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top-5.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->

@endsection