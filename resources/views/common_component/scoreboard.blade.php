<div class="nk-widget nk-widget-highlighted">
    <h4 class="nk-widget-title"><span><span class="text-main-1">Scoreboard</span></span></h4>
    <div class="nk-widget-content">
        @isset($sort_match)
            @foreach($sort_match as $val)
                <?php
                    $team_data = json_decode($val->match_data->team);
                    $score = json_decode($val->match_data->fin_score);
                ?>
                <div class="nk-widget-match" style="padding: 5px 10px;">
                    <a href="{{route('match_page',['id' => $val->match_data->id,'type' => $val->type])}}">
                        <span class="nk-widget-match-left">
                            <span class="nk-widget-match-teams">
                                <span class="nk-widget-match-vs mr-5">
                                    {{date('d/m',strtotime($val->match_data->match_day))}}
                                </span>
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
                                @if($val->type == 'upcoming_matches')
                                    <span class="nk-widget-match-vs ml-10">
                                    {{date('H:i',strtotime($val->match_data->match_day))}}
                                    </span>
                                @elseif($val->type == 'live_match')
                                    <span class="nk-widget-match-vs ml-10 text-warning">
                                        {{__('LIVE!')}}
                                    </span>
                                @elseif($val->type == 'latest_match')
                                    <span class="nk-match-score p-3 ml-10" style="font-size: 1.3rem;">
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
                            </span>
                        </span>
                        <span class="nk-widget-match-right">
                            <span class="fa fa-comments"></span>
                            <span href="#">
                                {{\Illuminate\Support\Facades\DB::table('comments_match')->where('match_id',$val->match_data->id)->count()}}
                            </span>
                        </span>
                    </a>
                </div>
            @endforeach
        @endisset
    </div>
    <a href="{{route('latest_matches')}}" class="nk-btn nk-btn-rounded nk-btn-color-main-1 mt-10" style="margin: 0 auto;display: block;width: 150px;">
        View more
    </a>
</div>