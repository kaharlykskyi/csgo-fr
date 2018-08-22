<div class="nk-gap-2"></div>
<h3 class="nk-decorated-h-2"><span><span class="text-main-1">Live</span> Matches</span></h3>
<div class="nk-gap"></div>
<div class="row">
    <div class="col-12">
        <div class="nk-match-score bg-dark-3">
            Now Playing
        </div>
        @forelse($live_match as $val)
            <?php
                $team = json_decode($val->team);
                $score = json_decode($val->fin_score);
            ?>
            <div class="nk-match">
                <div class="nk-match-team-left">
                    <a class="logo-team-block" href="{{route('match_page',['id' => $val->id,'type' => 'live-matches'])}}">
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
                    <a href="{{route('match_page',['id' => $val->id,'type' => 'live-matches'])}}">
                        <span class="nk-match-status-vs">VS</span>
                        @if(isset($score[0]->score_team1) && isset($score[0]->score_team2))
                            <span class="nk-match-score">
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
                        @isset($val->match_day)
                            <span class="nk-match-status-date mt-10">{{$val->match_day}}</span>
                        @endisset
                    </a>
                </div>
                <div class="nk-match-team-right">
                    <a class="logo-team-block" href="{{route('match_page',['id' => $val->id,'type' => 'live-matches'])}}">
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
        @empty
            <div class="nk-gap"></div>
        @endforelse
    </div>
</div>

<div class="nk-gap-4"></div>

<h3 class="nk-decorated-h-2"><span><span class="text-main-1">UPCOMING </span> MATCHES</span></h3>

<div class="row">
    <div class="col-12">
        @forelse($upcoming_matches as $val)
            <?php
            $team = json_decode($val->team);
            $score = json_decode($val->fin_score);
            ?>
            <div class="nk-match">
                <div class="nk-match-team-left">
                    <a class="logo-team-block" href="{{route('match_page',['id' => $val->id,'type' => 'upcoming-matches'])}}">
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
                    <a href="{{route('match_page',['id' => $val->id,'type' => 'upcoming-matches'])}}">
                        <span class="nk-match-status-vs">VS</span>
                        @if(isset($score[0]->score_team1) && isset($score[0]->score_team2))
                            <span class="nk-match-score">
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
                        @isset($val->match_day)
                            <span class="nk-match-status-date mt-10">{{$val->match_day}}</span>
                        @endisset
                    </a>
                </div>
                <div class="nk-match-team-right">
                    <a class="logo-team-block" href="{{route('match_page',['id' => $val->id,'type' => 'upcoming-matches'])}}">
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
        @empty
            <div class="nk-gap"></div>
        @endforelse
    </div>

</div>

<div class="nk-gap-4"></div>

<h3 class="nk-decorated-h-2"><span><span class="text-main-1">Latest</span> Matches</span></h3>
@forelse($latest_match as $val)
    <?php
    $team = json_decode($val->team);
    $score = json_decode($val->fin_score);
    ?>
    <div class="nk-match">
        <div class="nk-match-team-left">
            <a class="logo-team-block" href="{{route('match_page',['id' => $val->id,'type' => 'latest-matches'])}}">
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
            <a href="{{route('match_page',['id' => $val->id,'type' => 'latest-matches'])}}">
                <span class="nk-match-status-vs">VS</span>
                @if(isset($score[0]->score_team1) && isset($score[0]->score_team2))
                    <span class="nk-match-score">
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
                @isset($val->match_day)
                    <span class="nk-match-status-date mt-10">{{$val->match_day}}</span>
                @endisset
            </a>
        </div>
        <div class="nk-match-team-right">
            <a class="logo-team-block" href="{{route('match_page',['id' => $val->id,'type' => 'latest-matches'])}}">
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
@empty
    <div class="nk-gap"></div>
@endforelse

