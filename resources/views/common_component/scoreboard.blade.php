<div class="nk-widget nk-widget-highlighted">
    <h4 class="nk-widget-title"><span><span class="text-main-1">Scoreboard</span></span></h4>
    <div class="nk-widget-content">
        @isset($sort_match)
            @php
                $prePage = \Illuminate\Support\Facades\DB::table('settings')->where('name','=','pre_match_scoreboard')->select('value')->first();
                $chunk = array_chunk($sort_match,(int)$prePage->value);
                $count = count($chunk);
            @endphp
            <div class="tab-content" id="nav-tabContent">
                @foreach($chunk as $k => $item)
                    <div class="tab-pane fade @if($k == 0){{__(' show active')}}@endif" id="page-{{$k}}" role="tabpanel" aria-labelledby="nav-home-tab">
                        @foreach($item as $k => $val)
                            @php
                                $team_data = json_decode($val->match_data->team);
                                $score = json_decode($val->match_data->fin_score);
                            @endphp
                            <div class="nk-widget-match" style="padding: 5px;">
                                <a href="{{route('match_page',['id' => $val->match_data->id,'type' => $val->type])}}">
                        <span class="nk-widget-match-left">
                            <span class="nk-widget-match-teams">
                                <span class="nk-widget-match-vs mr-10">
                                    {{date('d/m',strtotime($val->match_data->match_day))}}
                                </span>
                                @isset($team_data)
                                    <span class="nk-widget-match-team-logo">
                                    @foreach($teams as $team)
                                            @if($team->id == $team_data->team_names1)
                                                <span class="nk-match-team-logo">
                                                <img class="rounded" src="@if(isset($team->logo)){{asset($team->logo)}}@else{{asset('images/photo_not_available.png')}}@endif" alt="{{$team->name}}">
                                            </span>
                                            @endif
                                        @endforeach
                                    </span>
                                        <span class="nk-widget-match-vs">VS</span>
                                        <span class="nk-widget-match-team-logo">
                                        @foreach($teams as $team)
                                                @if($team->id == $team_data->team_names2)
                                                    <span class="nk-match-team-logo">
                                                    <img class="rounded" src="@if(isset($team->logo)){{asset($team->logo)}}@else{{asset('images/photo_not_available.png')}}@endif" alt="{{$team->name}}">
                                                </span>
                                                @endif
                                            @endforeach
                                    </span>
                                @endisset
                                @if($val->type == 'upcoming_matches')
                                    <span class="nk-widget-match-vs ml-15">
                                    {{date('H:i',strtotime($val->match_data->match_day))}}
                                    </span>
                                @elseif($val->type == 'live_match')
                                    <span class="nk-widget-match-vs ml-15 text-warning">
                                        {{__('LIVE!')}}
                                    </span>
                                @elseif($val->type == 'latest_match')
                                    <span class="nk-match-score p-3 ml-15" style="font-size: 1.3rem;">
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
                                <span class="nk-widget-match-team-logo ml-15">
                                    @php
                                        $tournament = \Illuminate\Support\Facades\DB::table('tournaments')->where('id',$val->match_data->tournament)->first();
                                    @endphp
                                    @isset($tournament)
                                        <span class="nk-match-team-logo">
                                            <img class="rounded" src="{{asset($tournament->tournament_logo)}}" alt="">
                                        </span>
                                    @endisset
                                </span>
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
                    </div>
                @endforeach
            </div>
            @if($count > 1)
                <nav class="mt-40 mb-5">
                    <div class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                        @for($i = 0;$i < $count; $i++)
                            <a class="nav-item nav-link @if($i == 0){{__('active')}}@endif" id="nav-home-tab" data-toggle="tab" href="#page-{{$i}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$i + 1}}</a>
                        @endfor
                    </div>
                </nav>
            @endif
        @endisset
    </div>
    <a href="{{route('latest_matches')}}" class="nk-btn nk-btn-rounded nk-btn-color-main-1 mt-10" style="margin: 0 auto;display: block;width: 150px;">
        View more
    </a>
</div>