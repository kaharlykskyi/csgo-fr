@extends('layouts.app')

@section('content')

    <?php
    $team = json_decode($match->team);
    $streams = json_decode($match->stream_link);
    $maps = json_decode($match->map);
    $score = json_decode($match->fin_score);
    ?>

    <div class="nk-gap-2"></div>
    <div class="row vertical-gap">
        <div class="col-lg-8">

            @component('matches.component.breadcrumb',['type' => 'Matches'])

            @endcomponent

            <div class="nk-match">
                <div class="nk-match-team-left">
                    <a class="logo-team-block" href="#">
                        @if(isset($team->team1_logo) && isset($team->team_names1))
                            <span class="nk-match-team-logo">
                                <img src="{{ asset($team->team1_logo) }}" alt="{{$team->team_names1}}">
                            </span>
                        @endif
                        @isset($team->team_names1)
                            <span class="nk-match-team-name">
                                {{$team->team_names1}}
                            </span>
                        @endisset
                    </a>
                </div>
                <div class="nk-match-status">
                    <a class="" href="#">
                        @if(isset($score[0]->score_team1) && isset($score[0]->score_team2))
                            <span style="font-size: 2rem;" class="nk-match-score">
                                <span class="@if($score[0]->score_team1 >= $score[0]->score_team2)
                                {{__('text-success')}}
                                @else
                                {{__('text-danger')}}
                                @endif ">{{$score[0]->score_team1}}</span> : <span class="@if($score[0]->score_team2 >= $score[0]->score_team1)
                                {{__('text-success')}}
                                @else
                                {{__('text-danger')}}
                                @endif ">{{$score[0]->score_team2}}</span>
                            </span>
                        @endif
                        @if(isset($score[0]))
                            <span class="nk-match-status-vs">
                                    {{$match->match_day}}
                                </span>
                        @endif
                    </a>
                </div>
                <div class="nk-match-team-right">
                    <a class="logo-team-block" href="#">
                        @isset($team->team_names2)
                            <span class="nk-match-team-name">
                                    {{$team->team_names2}}
                            </span>
                        @endisset
                        @if(isset($team->team2_logo) && isset($team->team_names2))
                            <span class="nk-match-team-logo">
                                <img src="{{ asset($team->team2_logo) }}" alt="{{$team->team_names2}}">
                            </span>
                        @endif
                    </a>
                </div>
            </div>

            <div class="nk-gap-2"></div>

            <div class="team-content">
                <div class="row">
                    <div class="col-6">
                        @forelse($team->team_users1Array as $user)

                            <div class="row">
                                <div class="col-2">
                                    @isset($user->country_id)
                                        @foreach($countrys as $country)

                                            @if($country->country == $user->country_id)
                                                <img src="{{asset('images/flag/' . $country->flag)}}" alt="{{$country->country}}">
                                            @endif

                                        @endforeach
                                    @endisset
                                </div>
                                <div class="col-10">
                                    @isset($user->user_name)
                                        <p class="text-white">{{$user->user_name}}</p>
                                    @endisset
                                </div>
                            </div>
                        @empty

                        @endforelse
                    </div>

                    <div class="col-6">
                        @forelse($team->team_users2Array as $user)

                            <div class="row">
                                <div class="col-10">
                                    @isset($user->user_name)
                                        <p class="text-right text-white">{{$user->user_name}}</p>
                                    @endisset
                                </div>
                                <div class="col-2">
                                    @isset($user->country_id)
                                        @foreach($countrys as $country)
                                            @if($country->country == $user->country_id)
                                                <img src="{{asset('images/flag/' . $country->flag)}}" alt="{{$country->country}}">
                                            @endif
                                        @endforeach
                                    @endisset
                                </div>
                            </div>

                        @empty

                        @endforelse
                    </div>
                </div>
            </div>

            <div class="nk-gap-2"></div>

            <div class="team-content maps">
                @if(isset($maps))
                    @foreach($maps as $map)
                        <div class="row">
                            <div class="col-12">
                                @isset($map->map_name)
                                    <p class="h4 text-center">{{$map->map_name}}</p>
                                @endisset
                            </div>
                            <div class="col-2 text-center">
                                <span class="@if($map->team1_t > $map->team2_ct){{__('text-success')}}@else{{__('text-danger')}}@endif">T {{$map->team1_t}}</span><br>
                                <span class="@if($map->team1_ct > $map->team2_t){{__('text-success')}}@else{{__('text-danger')}}@endif">CT {{$map->team1_ct}}</span>
                                <p class="h3 @if(((integer)$map->team1_ct + (integer)$map->team1_t) > ((integer)$map->team2_ct + (integer)$map->team2_t))
                                {{__('text-success')}}
                                @else
                                {{__('text-danger')}}
                                @endif">{{(integer)$map->team1_ct + (integer)$map->team1_t}}</p>
                            </div>
                            <div class="col-8">
                                @if(isset($map->map_img))
                                    <img src="{{asset($map->map_img)}}" alt="">
                                @endif
                            </div>
                            <div class="col-2 text-center">
                                <span class="@if($map->team1_t < $map->team2_ct){{__('text-success')}}@else{{__('text-danger')}}@endif">CT {{$map->team2_ct}}</span><br>
                                <span class="@if($map->team1_ct < $map->team2_t){{__('text-success')}}@else{{__('text-danger')}}@endif">T {{$map->team2_t}}</span>
                                <p class="h3 @if(((integer)$map->team2_ct + (integer)$map->team2_t) > ((integer)$map->team1_ct + (integer)$map->team1_t))
                                {{__('text-success')}}
                                @else
                                {{__('text-danger')}}
                                @endif">{{(integer)$map->team2_ct + (integer)$map->team2_t}}</p>
                            </div>
                        </div>
                        <div class="nk-gap-2"></div>
                    @endforeach
                @else
                    <div class="row">
                        <div class="col-12">
                            <p class="h4 text-center">TBA</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="nk-gap-2"></div>

            @isset($tournament->title)
                <div class="team-content">
                    <p class="h4">Tournament</p>
                    <div class="row">
                        <div class="col-12">
                            <p style="color: #dd163b;">{{$tournament->title}}</p>
                        </div>
                    </div>
                </div>
            @endisset

            <div class="nk-gap-2"></div>

            @isset($streams)
                <div class="team-content">
                    <p class="h4">Stream links</p>
                    <div class="row">

                        @foreach($streams as $stream)
                            <div class="col-12">
                                <a href="{{$stream->link}}">{{$stream->link}}</a>
                            </div>
                        @endforeach

                    </div>
                </div>
            @endisset

        </div>
        <div class="col-lg-4">
            <!--
                START: Sidebar

                Additional Classes:
                    .nk-sidebar-left
                    .nk-sidebar-right
                    .nk-sidebar-sticky
            -->
        @component('common_component.sidebar',[
            'streams' => null,
            'sort_match' => null,
            'teams' => null
        ])

        @endcomponent
        <!-- END: Sidebar -->
        </div>
    </div>

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top-5.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->

@endsection