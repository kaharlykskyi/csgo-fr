<div class="nk-widget nk-widget-highlighted">
    <h4 class="nk-widget-title"><span><span class="text-main-1">Scoreboard</span></span></h4>
    <div class="nk-widget-content">
        @isset($upcoming_matches)
            @foreach($upcoming_matches as $val)
                <?php
                    $team_data = json_decode($val->team);
                ?>
                <div class="nk-widget-match">
                    <a href="{{route('match_page',['id' => $val->id,'type' => 'upcoming-matches'])}}">
                        <span class="nk-widget-match-left">
                            <span class="nk-widget-match-teams">
                                <span class="nk-widget-match-team-logo">
                                    @foreach($teams as $team)
                                        @if($team->id == $team_data->team_names1)
                                            <span class="nk-match-team-logo">
                                                <img class="rounded" src="{{ asset($team->logo) }}" alt="{{$team->name}}">
                                            </span>
                                        @endif
                                    @endforeach
                                </span>
                                <span class="nk-widget-match-vs">VS</span>
                                <span class="nk-widget-match-team-logo">
                                    @foreach($teams as $team)
                                        @if($team->id == $team_data->team_names2)
                                            <span class="nk-match-team-logo">
                                                <img class="rounded" src="{{ asset($team->logo) }}" alt="{{$team->name}}">
                                            </span>
                                        @endif
                                    @endforeach
                                </span>
                                <span class="nk-widget-match-vs">
                                    {{date('d/m',strtotime($val->match_day))}}
                                </span>
                            </span>
                        </span>
                        <span class="nk-widget-match-right">
                            <span class="fa fa-comments"></span>
                            <span href="#">
                                {{\Illuminate\Support\Facades\DB::table('comments_match')->where('match_id',$val->id)->count()}}
                            </span>
                        </span>
                    </a>
                </div>
            @endforeach
        @endisset

        @isset($live_match)
                @foreach($live_match as $val)
                    <?php
                    $team_data = json_decode($val->team);
                    ?>
                    <div class="nk-widget-match">
                        <a href="{{route('match_page',['id' => $val->id,'type' => 'live-matches'])}}">
                        <span class="nk-widget-match-left">
                            <span class="nk-widget-match-teams">
                                <span class="nk-widget-match-team-logo">
                                    @foreach($teams as $team)
                                        @if($team->id == $team_data->team_names1)
                                            <span class="nk-match-team-logo">
                                                <img class="rounded" src="{{ asset($team->logo) }}" alt="{{$team->name}}">
                                            </span>
                                        @endif
                                    @endforeach
                                </span>
                                <span class="nk-widget-match-vs">VS</span>
                                <span class="nk-widget-match-team-logo">
                                    @foreach($teams as $team)
                                        @if($team->id == $team_data->team_names2)
                                            <span class="nk-match-team-logo">
                                                <img class="rounded" src="{{ asset($team->logo) }}" alt="{{$team->name}}">
                                            </span>
                                        @endif
                                    @endforeach
                                </span>
                                <span class="nk-widget-match-vs ml-3 text-warning">
                                    {{__('LIVE!')}}
                                </span>
                            </span>
                        </span>
                            <span class="nk-widget-match-right">
                            <span class="fa fa-comments"></span>
                            <span href="#">
                                {{\Illuminate\Support\Facades\DB::table('comments_match')->where('match_id',$val->id)->count()}}
                            </span>
                        </span>
                        </a>
                    </div>
                @endforeach
            @endisset

        @isset($latest_match)
                @foreach($latest_match as $val)
                    <?php
                    $team_data = json_decode($val->team);
                    $score = json_decode($val->fin_score);
                    ?>
                    <div class="nk-widget-match">
                        <a href="{{route('match_page',['id' => $val->id,'type' => 'latest-matches'])}}">
                        <span class="nk-widget-match-left">
                            <span class="nk-widget-match-teams">
                                <span class="nk-widget-match-team-logo">
                                    @foreach($teams as $team)
                                        @if($team->id == $team_data->team_names1)
                                            <span class="nk-match-team-logo">
                                                <img class="rounded" src="{{ asset($team->logo) }}" alt="{{$team->name}}">
                                            </span>
                                        @endif
                                    @endforeach
                                </span>
                                <span class="nk-widget-match-vs">VS</span>
                                <span class="nk-widget-match-team-logo">
                                    @foreach($teams as $team)
                                        @if($team->id == $team_data->team_names2)
                                            <span class="nk-match-team-logo">
                                                <img class="rounded" src="{{ asset($team->logo) }}" alt="{{$team->name}}">
                                            </span>
                                        @endif
                                    @endforeach
                                </span>
                                <span class="nk-widget-match-vs ml-3">
                                    <span class="nk-match-score p-3" style="font-size: 1.3rem;">
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
                                </span>
                            </span>
                        </span>
                            <span class="nk-widget-match-right">
                            <span class="fa fa-comments"></span>
                            <span href="#">
                                {{\Illuminate\Support\Facades\DB::table('comments_match')->where('match_id',$val->id)->count()}}
                            </span>
                        </span>
                        </a>
                    </div>
                @endforeach
            @endisset
    </div>
    <a href="{{route('latest_matches')}}" class="nk-btn nk-btn-outline nk-btn-color-success mt-2" style="margin: 0 auto;display: block;width: 150px;">
        View more
    </a>
</div>