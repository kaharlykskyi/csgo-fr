@extends('layouts.app')

@section('content')

    <div class="nk-gap-2"></div>
    <div class="row vertical-gap">
        <div class="col-lg-8">

            @component('matches.component.breadcrumb',['type' => 'Latest Matches'])

            @endcomponent

                <table class="nk-table">
                    <thead>
                        <tr>
                            <th colspan="3">Latest Matches</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($latest_match_notlimit)
                            @foreach($latest_match_notlimit as $item)
                                <?php
                                    $team_data = json_decode($item->team);
                                    $score = json_decode($item->fin_score);
                                ?>
                                <tr>
                                    <td>
                                        <a href="{{route('match_page',$item->id)}}">
                                            @foreach($teams as $team)
                                                @if($team->id == $team_data->team_names1)
                                                    <img class="rounded with-50" src="{{ asset($team->logo) }}" alt="{{$team->name}}">
                                                @endif
                                            @endforeach
                                            <span class="nk-widget-match-vs">VS</span>
                                            @foreach($teams as $team)
                                                @if($team->id == $team_data->team_names2)
                                                    <img class="rounded with-50" src="{{ asset($team->logo) }}" alt="{{$team->name}}">
                                                @endif
                                            @endforeach
                                        </a>
                                    </td>
                                    <td class="flex-center">
                                        <span class="nk-match-score" style="font-size: 1.3rem;">
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
                                    </td>
                                    <td class="text-center">
                                        {{$item->match_day}}
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                {{$latest_match_notlimit->links()}}
                            </td>
                        </tr>
                    </tfoot>
                </table>

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