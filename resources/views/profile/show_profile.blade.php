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
        <div class="col-lg-8">
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
                                <em>description</em>
                                <div  class="text-white">{{$user->description}}</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-l-0">
                                <div class="col-12 p-0">
                                    <p class="h5">Social Profiles</p>
                                    <div class="nk-widget nk-widget-highlighted mt-5">
                                        <div class="nk-widget-content">
                                            <ul class="nk-social-links-3 nk-social-links-cols-3">
                                                @isset($user->twitch_profile)
                                                    <li>
                                                        <a class="nk-social-twitch" href="{{$user->twitch_profile}}" target="_blank">
                                                            <span class="fab fa-twitch"></span>
                                                        </a>
                                                    </li>
                                                @endisset
                                                @isset($user->steam_profile)
                                                    <li><a class="nk-social-steam" href="{{$user->steam_profile}}" target="_blank"><span class="fab fa-steam"></span></a></li>
                                                @endisset
                                                @isset($user->youtube_profile)
                                                    <li><a class="nk-social-youtube" href="{{$user->youtube_profile}}" target="_blank"><span class="fab fa-youtube"></span></a></li>
                                                @endisset
                                                @isset($user->instagram_profile)
                                                    <li><a class="nk-social-instagram" href="{{$user->instagram_profile}}" target="_blank"><span class="fab fa-instagram"></span></a></li>
                                                @endisset
                                                @isset($user->twitter_profile)
                                                    <li><a class="nk-social-twitter" href="{{$user->twitter_profile}}" target="_blank"><span class="fab fa-twitter"></span></a></li>
                                                @endisset
                                                @isset($user->faceit_profile)
                                                        <li><a class="nk-social-github" href="{{$user->faceit_profile}}">
                                                                <svg viewBox="0 0 39 34" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M17 0L34 9.75V29.25L17 39L1.26115e-08 29.25V9.75L17 0Z" transform="translate(0 34) rotate(-90)" fill="rgba(0,0,0,0)"></path>
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17 3.51823L3.06717 11.5091V27.4909L17 35.4818L30.9328 27.4909V11.5091L17 3.51823ZM34 9.75L17 0L0 9.75V29.25L17 39L34 29.25V9.75Z" transform="translate(0 34) rotate(-90)" fill="#FCF5EB"></path>
                                                                    <path d="M14.625 0.109914C14.625 -0.00750568 14.4868 -0.0368597 14.4315 0.0512051C12.6626 2.95734 11.6399 4.60121 10.7554 6.12767C7.38337 6.12767 2.54641 6.12767 0.141743 6.12767C0.00354423 6.12767 -0.0517489 6.30381 0.0588104 6.36252C4.45354 8.12381 10.8107 10.7951 14.3763 12.2629C14.4592 12.2922 14.625 12.2041 14.625 12.1454V0.109914Z" transform="translate(10.9688 10.8652)" fill="#FCF5EB"></path>
                                                                </svg></a></li>
                                                @endisset
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-10">
                                <em>account created</em>
                                <div  class="text-white">{{date('M d Y',strtotime($user->created_at))}}</div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END: Teammate Card -->
        </div>
        <div class="col-lg-4">
            @component('profile.component.last_info',[
                'last_forum_mass' => $last_forum_mass,
                'last_forum_topic' => $last_forum_topic,
                'comments' => $comments
            ])

            @endcomponent
        </div>
    </div>

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top-5.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->

@endsection