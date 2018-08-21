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
            ?>
            <div class="nk-gap-2"></div>
            <div class="nk-match">
                <div class="nk-match-team-left">
                    <a class="logo-team-block" href="#">
                        <span class="nk-match-team-logo">
                            <img src="{{ asset($team->team1_logo) }}" alt="{{$team->team_names1}}">
                        </span>
                        <span class="nk-match-team-name">
                            {{$team->team_names1}}
                        </span>
                    </a>
                </div>
                <div class="nk-match-status">
                    <a href="#">
                        <span class="nk-match-status-vs">VS</span>
                    </a>
                </div>
                <div class="nk-match-team-right">
                    <a class="logo-team-block" href="#">
                        <span class="nk-match-team-name">
                           {{$team->team_names2}}
                        </span>
                        <span class="nk-match-team-logo">
                            <img src="{{ asset($team->team2_logo) }}" alt="{{$team->team_names2}}">
                        </span>
                    </a>
                </div>
            </div>
            <div class="nk-gap-2"></div>
            <a href="{{route('match_page',['id' => $val->id,'type' => 'Live Matches'])}}" class="nk-btn nk-btn-rounded nk-btn-color-main-1">Match Details</a>
            <div class="nk-gap-2"></div>
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
            ?>
            <div class="nk-gap-2"></div>
            <div class="nk-match">
                <div class="nk-match-team-left">
                    <a class="logo-team-block" href="#">
                        <span class="nk-match-team-logo">
                            <img src="{{ asset($team->team1_logo) }}" alt="{{$team->team_names1}}">
                        </span>
                        <span class="nk-match-team-name">
                            {{$team->team_names1}}
                        </span>
                    </a>
                </div>
                <div class="nk-match-status">
                    <a href="#">
                        <span class="nk-match-status-vs">VS</span>
                        <span class="nk-match-status-date">{{$val->match_day}}</span>
                    </a>
                </div>
                <div class="nk-match-team-right">
                    <a class="logo-team-block" href="#">
                        <span class="nk-match-team-name">
                           {{$team->team_names2}}
                        </span>
                        <span class="nk-match-team-logo">
                            <img src="{{ asset($team->team2_logo) }}" alt="{{$team->team_names2}}">
                        </span>
                    </a>
                </div>
            </div>
            <div class="nk-gap-2"></div>
            <a href="{{route('match_page',['id' => $val->id,'type' => 'Upcoming Matches'])}}" class="nk-btn nk-btn-rounded nk-btn-color-main-1">Match Details</a>
            <div class="nk-gap"></div>
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
    <div class="nk-gap-2"></div>
    <div class="nk-match">
        <div class="nk-match-team-left">
            <a class="logo-team-block" href="{{route('match_page',$val->id)}}">
                        <span class="nk-match-team-logo">
                            <img src="{{ asset($team->team1_logo) }}" alt="{{$team->team_names1}}">
                        </span>
                <span class="nk-match-team-name">
                            {{$team->team_names1}}
                        </span>
            </a>
        </div>
        <div class="nk-match-status">
            <a href="#">
                <span class="nk-match-status-vs">VS</span>
                <span class="nk-match-status-date">{{$val->match_day}}</span>
                <span class="nk-match-score bg-danger">
                            {{$score[0]->score_team1}} : {{$score[0]->score_team2}}
                        </span>
            </a>
        </div>
        <div class="nk-match-team-right">
            <a class="logo-team-block" href="{{route('match_page',$val->id)}}">
                        <span class="nk-match-team-name">
                           {{$team->team_names2}}
                        </span>
                <span class="nk-match-team-logo">
                            <img src="{{ asset($team->team2_logo) }}" alt="{{$team->team_names2}}">
                        </span>
            </a>
        </div>
    </div>
    <div class="nk-gap"></div>
    <a href="{{route('match_page',['id' => $val->id,'type' => 'Latest Matches'])}}" class="nk-btn nk-btn-rounded nk-btn-color-main-1">Match Details</a>
    <div class="nk-gap-2"></div>
@empty
    <div class="nk-gap"></div>
@endforelse

