@extends('layouts.app')

@section('content')
    <div class="row vertical-gap">
        <div class="col-lg-8">

            @component('player_page.component.breadcrumb',['title' => $team->name])

            @endcomponent

            <div class="nk-gap-2"></div>

            <div class="row">
                <div class="col-12 p-0">
                    <!-- START: Tabs  -->
                    <div class="nk-tabs">
                        <!--
                            Additional Classes:
                                .nav-tabs-fill
                        -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#tabs-1-1" role="tab" data-toggle="tab"><em>{{$team->name}}</em> team profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tabs-1-2" role="tab" data-toggle="tab">History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tabs-1-3" role="tab" data-toggle="tab">Statistics</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="tabs-1-1">
                                <div class="nk-gap"></div>

                                <table class="nk-table">
                                    <thead>
                                        <tr>
                                            <th colspan="3">Information</th>
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
                                        <tr>
                                            <td>Game</td>
                                            <td>{{$team->game}}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="nk-gap-2"></div>

                                <table class="nk-table">
                                    <thead>
                                    <tr>
                                        <th colspan="6">Compound</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @isset($players)
                                                @foreach($players as $player)
                                                    <td class="text-center">
                                                        <a style="text-decoration: none !important;" href="{{route('player_page',$player->nickname)}}">
                                                            <img style="max-width: 100px;width: 100%;" src="@if(isset($player->logo)){{asset($player->logo)}}@else{{asset('images/obama_meme_by_zcoogerchannel-d4xo8rx.png')}}@endif" alt="">
                                                            @isset($player->full_name)
                                                                <p class="p-1 m-0">{{$player->full_name}}</p>
                                                            @endisset
                                                            <p class="p-1 m-0">{{$player->nickname}}</p>
                                                            <p class="p-1 m-0">{{$player->account_type}}</p>
                                                        </a>
                                                    </td>
                                                @endforeach
                                            @endisset
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="nk-gap-2"></div>

                                <table class="nk-table">
                                    <thead>
                                        <tr>
                                            <th>Latest matches</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($team_latest_match)
                                            @foreach($team_latest_match as $val)
                                                <tr>
                                                    <td>
                                                        <a href="{{route('match_page',['id' => $val->match->id,'type' => 'latest-matches'])}}">
                                                            {{$val->team1->name}}<strong> VS </strong>{{$val->team2->name}} - {{$val->match->match_day}}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                    </tbody>
                                </table>

                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tabs-1-2">
                                <div class="nk-gap"></div>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="nk-table">
                                            <tbody>
                                                @isset($history)
                                                    @foreach($history as $item)
                                                        <tr>
                                                            <td>
                                                                {{$item->message}} - {{$item->created_at}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endisset
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="nk-gap"></div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tabs-1-3">
                                <div class="nk-gap"></div>
                                <p>I have related the substance of several conversations I had with my master during the greatest part of the time I had the, for brevity sake, omitted much moredown.</p>
                                <div class="nk-gap"></div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Tabs -->
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
            'latest_match' => $latest_match,
            'live_match' => $live_match,
            'upcoming_matches' => $upcoming_matches,
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