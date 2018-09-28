@extends('layouts.app')

@section('content')
    <div class="row vertical-gap">
        <div class="col-lg-8">

        @component('player_page.component.breadcrumb',['title' => $player->nickname])

        @endcomponent

        <div class="row">
            <div class="col-12 p-0">
                <table class="nk-table">
                    <thead>
                    <tr>
                        <th colspan="3">information for <em>{{$player->nickname}}</em></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Full name</td>
                        <td>{{$player->full_name}}</td>
                        <td rowspan="5" class="text-center" style="width: 150px">
                            <img style="max-width: 150px" src="@if(isset($player->logo)){{asset($player->logo)}}@else{{asset('images/photo_not_available.png')}}@endif" alt="$player->nickname">
                        </td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>
                            @isset($player->country)
                                @foreach($countrys as $country)
                                    @if($country->country == $player->country)
                                        <img style="margin-right: 5px;" src="{{asset('images/flag/' . $country->flag)}}" alt="{{$country->country}}"><span>{{$country->country}}</span>
                                    @endif
                                @endforeach
                            @endisset
                        </td>
                    </tr>
                    @isset($player->age)
                        <tr>
                            <td>Ages</td>
                            <td>{{$player->age}}</td>
                        </tr>
                    @endisset
                    @isset($team->name)
                        <tr>
                            <td>Team</td>
                            <td>{{$team->name}}</td>
                        </tr>
                    @endisset
                    <tr>
                        <td>Last update</td>
                        <td>{{$player->updated_at}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

            <div class="nk-gap-2"></div>

            <div class="row">
                <div class="col-12 p-0">
                    <table class="nk-table">
                        <thead>
                        <tr>
                            <th colspan="3">Team information</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td rowspan="5" class="text-center" style="width: 150px">
                                <img style="max-width: 150px" src="@if(isset($team->logo)){{asset($team->logo)}}@else{{asset('images/obama_meme_by_zcoogerchannel-d4xo8rx.png')}}@endif" alt="$player->nickname">
                            </td>
                            <td>Team name</td>
                            <td>{{$team->name}}</td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>
                                @isset($team->country)
                                    @foreach($countrys as $country)
                                        @if($country->country == $team->country)
                                            <img style="margin-right: 5px;" src="{{asset('images/flag/' . $country->flag)}}" alt="{{$country->country}}"><span>{{$country->country}}</span>
                                        @endif
                                    @endforeach
                                @endisset
                            </td>
                        </tr>
                        @isset($team_players)
                            <tr>
                                <td>Structure</td>
                                <td>
                                    @foreach($team_players as $item)
                                        <a href="{{route('player_page',$item->nickname)}}">{{$item->nickname}}</a><br>
                                    @endforeach
                                </td>
                            </tr>
                        @endisset
                        @isset($team->name)
                            <tr>
                                <td>Game</td>
                                <td>{{$team->game}}</td>
                            </tr>
                        @endisset
                        <tr>
                            <td>Last update</td>
                            <td>{{$team->updated_at}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="nk-gap-2"></div>

            <div class="row">
                <div class="col-12 p-0">
                    <!-- START: Table -->
                    <table class="nk-table">
                        <thead>
                            <tr>
                                <th>Latest matches</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($player_latest_match)
                                @foreach($player_latest_match as $val)
                                    <tr>
                                        <td>
                                            <?php
                                            $score = json_decode($val->match->fin_score);
                                            ?>
                                            <a href="{{route('match_page',['id' => $val->match->id,'type' => 'latest-matches'])}}">
                                                {{$val->team1->name}}<strong> VS </strong>{{$val->team2->name}} <strong class="text-main-1 text-white"><em>{{$score[0]->score_team1}}</em> : <em>{{$score[0]->score_team2}}</em></strong> - {{$val->match->match_day}}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                    <!-- END: Table -->
                </div>
            </div>

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
            'streams' => $streams_output,
            'sort_match' => $sort_match,
            'teams' => $teams
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