@extends('layouts.app')

@section('content')

    <?php
        $streams = json_decode($match_data->stream_link);
        $maps = json_decode($match_data->map);
        $score = json_decode($match_data->fin_score);
    ?>

    <div class="row vertical-gap">
        <div class="col-lg-8">

            @component('matches.component.breadcrumb',['type' => $type_match])

            @endcomponent

            <div class="nk-match">
                <div class="nk-match-team-left">
                    <a class="logo-team-block" href="{{route('team_page',$team->team1->name)}}">
                        @if(isset($team->team1))
                            <span class="nk-match-team-logo">
                                <img src="@if(isset($team->team1->logo)){{asset($team->team1->logo)}}@else{{asset('images/photo_not_available.png')}}@endif" alt="{{$team->team1->name}}">
                            </span>
                        @endif
                        @isset($team->team1)
                            <span class="nk-match-team-name">
                                {{$team->team1->name}}
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
                                    {{$match_data->match_day}}
                                </span>
                        @endif
                    </a>
                </div>
                <div class="nk-match-team-right">
                    @isset($team->team2)
                    <a class="logo-team-block" href="{{route('team_page',$team->team2->name)}}">
                        <span class="nk-match-team-name">
                            {{$team->team2->name}}
                        </span>
                        <span class="nk-match-team-logo">
                            <img src="@if(isset($team->team2->logo)){{asset($team->team2->logo)}}@else{{asset('images/photo_not_available.png')}}@endif" alt="{{$team->team2->name}}">
                        </span>
                    </a>
                    @endisset
                </div>
            </div>

            <div class="nk-gap-2"></div>

            <div class="team-content">
                <div class="row">
                    <div class="col-6">
                        @forelse($team->players_team1 as $user)

                            <a href="{{route('player_page',$user->nickname)}}">
                                <div class="row">
                                    <div class="col-2">
                                        @isset($user->country)
                                            @foreach($countrys as $country)

                                                @if($country->country == $user->country)
                                                    <img src="{{asset('images/flag/' . $country->flag)}}" alt="{{$country->country}}">
                                                @endif

                                            @endforeach
                                        @endisset
                                    </div>
                                    <div class="col-10">
                                        @isset($user->nickname)
                                            <p class="text-white">{{$user->nickname}}</p>
                                        @endisset
                                    </div>
                                </div>
                            </a>
                        @empty

                        @endforelse
                    </div>

                    <div class="col-6">
                        @foreach($team->players_team2 as $user)

                            <a href="{{route('player_page',$user->nickname)}}">
                                <div class="row">
                                    <div class="col-10">
                                        @isset($user->nickname)
                                            <p class="text-right text-white">{{$user->nickname}}</p>
                                        @endisset
                                    </div>
                                    <div class="col-2">
                                        @isset($user->country)
                                            @foreach($countrys as $country)
                                                @if($country->country == $user->country)
                                                    <img src="{{asset('images/flag/' . $country->flag)}}" alt="{{$country->country}}">
                                                @endif
                                            @endforeach
                                        @endisset
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="nk-gap-2"></div>

            <div class="team-content maps">
                @if(isset($maps))
                    @foreach($maps as $map)
                        <?php
                            $sum = 0;
                            $sum2 = 0;
                            if(isset($map->map_score_tean1Array)){
                                foreach ($map->map_score_tean1Array as $item){
                                    $sum += (int)$item->score;
                                }
                            }
                            if (isset($map->map_score_tean2Array)){
                                foreach ($map->map_score_tean2Array as $item){
                                    $sum2 += (int)$item->score;
                                }
                            }
                        ?>
                        <div class="row">
                            <div class="col-2 text-center">
                                <?php  ?>
                                @isset($map->map_score_tean1Array)
                                    @foreach($map->map_score_tean1Array as $item)
                                        <p class="@if(strtolower($item->name) == 't'){{__('text-danger')}}@elseif(strtolower($item->name) == 'ct'){{__('text-primary')}}@else{{__('text-warning')}}@endif mb-2">
                                            <span>{{$item->name}}:</span>
                                            <span>{{$item->score}}</span>
                                        </p>
                                    @endforeach
                                @endisset
                                    <p class="h3 @if($sum > $sum2){{__('text-success')}}@else{{__('text-danger')}}@endif">{{$sum}}</p>
                            </div>
                            <div class="col-8 map-wrapper p-0">
                                @if(isset($map->map_id))
                                    <?php
                                        $map_inf = \Illuminate\Support\Facades\DB::table('match_maps')->where('id',$map->map_id)->first();
                                    ?>
                                    <div class="map-name-hover">
                                        @isset($map_inf->title)
                                            <p class="h4 text-center m-0 pt-10 pb-10">{{$map_inf->title}}</p>
                                        @endisset
                                    </div>
                                    <img src="{{asset($map_inf->path)}}" alt="">
                                @endif
                            </div>
                            <div class="col-2 text-center">
                                @isset($map->map_score_tean2Array)
                                    @foreach($map->map_score_tean2Array as $item)
                                        <p class="@if(strtolower($item->name) == 't'){{__('text-danger')}}@elseif(strtolower($item->name) == 'ct'){{__('text-primary')}}@else{{__('text-warning')}}@endif mb-2">
                                            <span>{{$item->name}}:</span>
                                            <span>{{$item->score}}</span>
                                        </p>
                                    @endforeach
                                @endisset
                                <p class="h3 @if($sum < $sum2){{__('text-success')}}@else{{__('text-danger')}}@endif">{{$sum2}}</p>
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

                <div class="team-content">
                    <p class="h4 m-t-5 m-b-5">Teams Photo</p>
                    <div class="row">
                        <div class="col-12">
                            <p class="h5 mb-5">{{$team->team1->name}}</p>
                        </div>
                        <table class="nk-table table-responsive">
                            <tbody>
                            <tr>
                                @isset($team->players_team1)
                                    @foreach($team->players_team1 as $player)
                                        <td class="text-center p-l-0 p-r-0">
                                            <a style="text-decoration: none !important;" href="{{route('player_page',$player->nickname)}}">
                                                <div class="team-palyer-avatar" style="background-image: url(@if(isset($player->logo)){{asset($player->logo)}}@else{{asset('images/photo_not_available.png')}}@endif)"></div>
                                                @isset($player->full_name)
                                                    <p class="p-1 m-0">{{$player->full_name}}</p>
                                                @endisset
                                                <p class="p-1 m-0 p-flag">
                                                    @foreach($countrys as $country)
                                                        @if($country->country == $player->country)
                                                            <img class="profile-flag" src="{{asset('images/flag/' . $country->flag)}}" alt="{{$country->country}}">
                                                        @endif
                                                    @endforeach
                                                    {{$player->nickname}}
                                                </p>
                                            </a>
                                        </td>
                                    @endforeach
                                @endisset
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="nk-gap-2"></div>
                    <div class="row">
                        <div class="col-12">
                            <p class="h5 mb-5">@isset($team->team2->name){{$team->team2->name}}@endisset</p>
                        </div>
                        <table class="nk-table table-responsive">
                            <tbody>
                            <tr>
                                @isset($team->players_team2)
                                    @foreach($team->players_team2 as $player)
                                        <td class="text-center p-l-0 p-r-0">
                                            <a style="text-decoration: none !important;" href="{{route('player_page',$player->nickname)}}">
                                                <div class="team-palyer-avatar" style="background-image: url(@if(isset($player->logo)){{asset($player->logo)}}@else{{asset('images/photo_not_available.png')}}@endif)"></div>
                                                @isset($player->full_name)
                                                    <p class="p-1 m-0">{{$player->full_name}}</p>
                                                @endisset
                                                <p class="p-1 m-0 p-flag">
                                                    @foreach($countrys as $country)
                                                        @if($country->country == $player->country)
                                                            <img class="profile-flag" src="{{asset('images/flag/' . $country->flag)}}" alt="{{$country->country}}">
                                                        @endif
                                                    @endforeach
                                                    {{$player->nickname}}
                                                </p>
                                            </a>
                                        </td>
                                    @endforeach
                                @endisset
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="nk-gap-2"></div>
                </div>


                <div class="nk-gap-2"></div>


                    <div class="team-content">
                        @isset($tournament->title)
                            <p class="h5 mb-1">Tournament</p>
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{route('tournament_page',$tournament->id)}}">{{$tournament->title}}</a>
                                </div>
                            </div>
                            <div class="nk-gap-2"></div>
                        @endisset
                            @isset($streams)
                                <p class="h5 mb-1">Stream links</p>
                                <div class="row">
                                    @foreach($streams as $k => $stream)
                                        <div class="col-12">
                                            <?php
                                                $channel = explode('/',$stream->link);
                                            ?>
                                            <script>
                                                $(document).ready(function(){
                                                    $.ajax({
                                                        beforeSend: function(xhrObj){
                                                            xhrObj.setRequestHeader("Client-ID","{{Illuminate\Support\Facades\Config::get('app.twitch_key')}}");
                                                            xhrObj.setRequestHeader("Accept","application/vnd.twitchtv.v5+json");
                                                        },
                                                        type: "GET",
                                                        url: "https://api.twitch.tv/kraken/users?login={{$channel[count($channel) - 1]}}",
                                                        processData: false,
                                                        dataType: "json",
                                                        success: function (data_user) {
                                                            $.ajax({
                                                                beforeSend: function(xhrObj){
                                                                    xhrObj.setRequestHeader("Client-ID","{{Illuminate\Support\Facades\Config::get('app.twitch_key')}}");
                                                                    xhrObj.setRequestHeader("Accept","application/vnd.twitchtv.v5+json");
                                                                },
                                                                type: "GET",
                                                                url: "https://api.twitch.tv/kraken/streams/" + data_user.users[0]._id,
                                                                processData: false,
                                                                dataType: "json",
                                                                userData: data_user,
                                                                success: function (data) {
                                                                    if(data.stream !== null){
                                                                        $('#stream-{{$k}}').html(
                                                                            '<span class="nk-widget-stream-status bg-success"></span>'+
                                                                            '<div class="nk-widget-stream-name">' +
                                                                                '<a href="#" data-toggle="collapse" data-target="#video-{{$k}}">' + data.stream.channel.display_name + '</a>' +
                                                                            '</div>'
                                                                        );
                                                                        if (data.stream.stream_type === 'live'){
                                                                            $('#stream-{{$k}}').append('<span class="nk-widget-stream-count"> ' + data.stream.viewers + ' viewers</span>');
                                                                        }
                                                                    } else {
                                                                        $('#stream-{{$k}}').html(
                                                                            '<span class="nk-widget-stream-status bg-danger"></span>'+
                                                                            '<div class="nk-widget-stream-name">' +
                                                                                '<a href="#" data-toggle="collapse" data-target="#video-{{$k}}">' + data_user.users[0].display_name + '</a>' +
                                                                            '</div>'
                                                                        );
                                                                    }
                                                                },
                                                            });
                                                        },
                                                    });
                                                });
                                            </script>
                                                <div class="nk-widget-stream mt-10" id="stream-{{$k}}"></div>
                                            <div id="video-{{$k}}" class="collapse">
                                                <div class="responsive-embed responsive-embed-16x9">
                                                    <iframe src="https://player.twitch.tv/?channel={{$channel[count($channel) - 1]}}&autoplay=false" frameborder="0" allowfullscreen="true" scrolling="no" height="378"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endisset
                    </div>

            <div class="nk-gap-2"></div>
            <!-- START: Comments -->
                @component('common_component.comments_output',[
                    'comments' => $comments,
                    'count' => $count,
                    'users' => $users,
                    'object' => $match_data,
                    'url' => route('match_comment_like'),
                    'url_comment' => route('match_comment')
                    ])

                @endcomponent
            <!-- END: Comments -->


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