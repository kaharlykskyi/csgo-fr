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

                @isset(Auth::user()->id)
                    @php
                        $voting_flag = \Illuminate\Support\Facades\DB::table('voting_matches')->where(['user_id' => Auth::user()->id,'match_id' => $match_data->id])
                            ->whereIn('team_id',[$team->team1->id,$team->team2->id])->first();
                    @endphp
                @endisset

                <div class="col-12 mb-15">
                    <div class="row">
                        <div class="col-6 p-0">
                            @if(!isset($voting_flag))
                                <form id="voting1" action="{{route('match_voting')}}" method="post" class="form-voting first">
                                    <input name="match" type="hidden" value="{{$match_data->id}}">
                                    <input name="team" type="hidden" value="{{$team->team1->id}}">
                                    <input name="other_team" type="hidden" value="{{$team->team2->id}}">
                                    <input name="form" type="hidden" value="first">
                                    @csrf
                                    <button type="submit" class="voting-button">
                                        +
                                    </button>
                                </form>
                            @endif
                            <div class="progress reverse-block">
                                <div id="progress-bar-one" class="progress-bar bg-success" role="progressbar" style="width: {{(($voting_data->team1 + $voting_data->team2) != 0) ? $voting_data->team1/($voting_data->team1 + $voting_data->team2) * 100: 0}}%" aria-valuenow="{{(($voting_data->team1 + $voting_data->team2) != 0) ? $voting_data->team1/($voting_data->team1 + $voting_data->team2) * 100: 0}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="match-info-wrapper">
                                <span class="ion-information-circled">
                                    <div class="match-info-wrapper__block">
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="text-uppercase text-center h6">prognosis</p>
                                            </div>
                                            <div class="col-6" id="match-info-wrapper__block-one">
                                                <p class="match-info-wrapper__block__team-name">{{$team->team1->name}}</p>
                                                <p class="match-info-wrapper__block__vote">{{$voting_data->team1}} vote(s)</p>
                                                <p class="match-info-wrapper__block__vote-percent">{{(($voting_data->team1 + $voting_data->team2) != 0) ? $voting_data->team1/($voting_data->team1 + $voting_data->team2) * 100: 0}} %</p>
                                            </div>
                                            <div class="col-6" id="match-info-wrapper__block-two">
                                                <p class="match-info-wrapper__block__team-name text-right">{{$team->team2->name}}</p>
                                                <p class="match-info-wrapper__block__vote text-right">{{$voting_data->team2}} vote(s)</p>
                                                <p class="match-info-wrapper__block__vote-percent text-right">{{(($voting_data->team1 + $voting_data->team2) != 0) ? $voting_data->team2/($voting_data->team1 + $voting_data->team2) * 100: 0}} %</p>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="col-6 p-0">
                            @if(!isset($voting_flag))
                                <form id="voting2" action="{{route('match_voting')}}" method="post" class="form-voting second">
                                    <input name="match" type="hidden" value="{{$match_data->id}}">
                                    <input name="team" type="hidden" value="{{$team->team2->id}}">
                                    <input name="other_team" type="hidden" value="{{$team->team1->id}}">
                                    <input name="form" type="hidden" value="second">
                                    @csrf
                                    <button type="submit" class="voting-button">
                                        +
                                    </button>
                                </form>
                            @endif
                            <div class="progress">
                                <div id="progress-bar-two" class="progress-bar" role="progressbar" style="width: {{(($voting_data->team1 + $voting_data->team2) != 0) ? $voting_data->team2/($voting_data->team1 + $voting_data->team2) * 100: 0}}%" aria-valuenow="{{(($voting_data->team1 + $voting_data->team2) != 0) ? $voting_data->team2/($voting_data->team1 + $voting_data->team2) * 100: 0}}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>

                    @if(!isset($voting_flag))
                        <script>
                            $(document).ready(function () {
                                $('#voting1, #voting2').submit(function () {
                                    $.ajax({
                                        url: $(this).attr('action'),
                                        type: 'POST',
                                        data: $(this).serialize(),
                                        success: function (data) {
                                            $('#voting1, #voting2').hide();
                                            $('#progress-bar-one').css({
                                                width: data.request.team1 / (data.request.team1 + data.request.team2) * 100 + '%'
                                            }).attr('aria-valuenow',data.request.team1 / (data.request.team1 + data.request.team2) * 100);
                                            $('#progress-bar-two').css({
                                                width: data.request.team2 / (data.request.team1 + data.request.team2) * 100 + '%'
                                            }).attr('aria-valuenow',data.request.team2 / (data.request.team1 + data.request.team2) * 100);
                                            $('#match-info-wrapper__block-one .match-info-wrapper__block__vote').text(data.request.team1 + ' vote(s)');
                                            $('#match-info-wrapper__block-two .match-info-wrapper__block__vote').text(data.request.team2 + ' vote(s)');
                                            $('#match-info-wrapper__block-one .match-info-wrapper__block__vote-percent')
                                                .text(data.request.team1 / (data.request.team1 + data.request.team2) * 100 + ' %');
                                            $('#match-info-wrapper__block-two .match-info-wrapper__block__vote-percent')
                                                .text(data.request.team2 / (data.request.team1 + data.request.team2) * 100 + ' %');
                                        }
                                    });
                                    return false;
                                })
                            })
                        </script>
                    @endif

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
                                            @if(stripos($stream->link,'www.twitch.tv') !== false)
                                                @php
                                                    $channel = explode('/',$stream->link);
                                                @endphp
                                                    <script>
                                                        $(document).ready(function(){
                                                            $.ajax({
                                                                beforeSend: function(xhrObj){
                                                                    xhrObj.setRequestHeader("Client-ID","{{Illuminate\Support\Facades\Config::get('app.twitch_key')}}");
                                                                    xhrObj.setRequestHeader("Accept","application/vnd.twitchtv.v5+json");
                                                                },
                                                                type: "GET",
                                                                url: "https://api.twitch.tv/kraken/users?login={{end($channel)}}",
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
                                                            <iframe src="https://player.twitch.tv/?channel={{end($channel)}}&autoplay=false" frameborder="0" allowfullscreen="true" scrolling="no" height="378"></iframe>
                                                        </div>
                                                    </div>
                                            @endif
                                            @if(stripos($stream->link,'youtube') !== false)
                                                    @php
                                                        $channel = explode('/',$stream->link);
                                                    @endphp
                                                    <script>
                                                        $(document).ready(function () {
                                                            $.ajax({
                                                                type: "GET",
                                                                url: "https://www.googleapis.com/youtube/v3/search?maxResults=1&part=snippet&channelId={{end($channel)}}&eventType=live&type=video&key=AIzaSyAOEkLY_mnud_KVyC-hM6ZmFitLHuyhe8Q",
                                                                processData: false,
                                                                dataType: "json",
                                                                success: function (data) {
                                                                    if (data.items.length > 0) {
                                                                        const name = data.items[0].snippet.channelTitle
                                                                        $.ajax({
                                                                            type: "GET",
                                                                            url: `https://www.googleapis.com/youtube/v3/videos?id=${data.items[0].id.videoId}&part=snippet,liveStreamingDetails&fields=items(id,snippet(title,liveBroadcastContent),liveStreamingDetails/concurrentViewers)&key=AIzaSyAOEkLY_mnud_KVyC-hM6ZmFitLHuyhe8Q`,
                                                                            processData: false,
                                                                            dataType: "json",
                                                                            success: function (data) {
                                                                                $('#stream-{{$k}}').html(
                                                                                    `<span class="nk-widget-stream-status bg-success"></span>
                                                                                                <div class="nk-widget-stream-name">
                                                                                                <a href="#" data-toggle="collapse" data-target="#video-{{$k}}">${name}</a>
                                                                                                </div>
                                                                                                <span class="nk-widget-stream-count">${data.items[0].liveStreamingDetails.concurrentViewers} viewers</span>`
                                                                                );
                                                                                $('#play{{$k}}').html(`
                                                                                                <iframe height="378" src="https://www.youtube.com/embed/${data.items[0].id}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                                                            `)
                                                                            }
                                                                        })
                                                                        console.log(data.items)
                                                                    }
                                                                },
                                                                error: function () {
                                                                    $.ajax({
                                                                        type: "GET",
                                                                        url: "https://www.googleapis.com/youtube/v3/search?maxResults=1&part=snippet&q={{end($channel)}}&eventType=live&type=video&key=AIzaSyAOEkLY_mnud_KVyC-hM6ZmFitLHuyhe8Q",
                                                                        processData: false,
                                                                        dataType: "json",
                                                                        success: function (data) {
                                                                            if (data.items.length > 0) {
                                                                                if (data.items.length > 0) {
                                                                                    const name = data.items[0].snippet.channelTitle
                                                                                    $.ajax({
                                                                                        type: "GET",
                                                                                        url: `https://www.googleapis.com/youtube/v3/videos?id=${data.items[0].id.videoId}&part=snippet,liveStreamingDetails&fields=items(id,snippet(title,liveBroadcastContent),liveStreamingDetails/concurrentViewers)&key=AIzaSyAOEkLY_mnud_KVyC-hM6ZmFitLHuyhe8Q`,
                                                                                        dataType: "json",
                                                                                        success: function (data) {
                                                                                            $('#stream-{{$k}}').html(
                                                                                                `<span class="nk-widget-stream-status bg-success"></span>
                                                                                                <div class="nk-widget-stream-name">
                                                                                                <a href="#" data-toggle="collapse" data-target="#video-{{$k}}">${name}</a>
                                                                                                </div>
                                                                                                <span class="nk-widget-stream-count">${data.items[0].liveStreamingDetails.concurrentViewers} viewers</span>`
                                                                                            );
                                                                                            $('#play{{$k}}').html(`
                                                                                                <iframe height="378" src="https://www.youtube.com/embed/${data.items[0].id}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                                                            `)
                                                                                        },
                                                                                        error: function (data) {
                                                                                            console.log(data)
                                                                                        }
                                                                                    })
                                                                                }
                                                                            }
                                                                        }
                                                                    })
                                                                }
                                                            })
                                                        });
                                                    </script>

                                                    <div class="nk-widget-stream mt-10" id="stream-{{$k}}"></div>
                                                    <div id="video-{{$k}}" class="collapse">
                                                        <div class="responsive-embed responsive-embed-16x9" id="play{{$k}}">
                                                        </div>
                                                    </div>
                                            @endif
                                            @if(stripos($stream->link,'facebook') !== false)
                                        {{--            <script>
                                                        $(document).ready(function () {
                                                            $.ajax({

                                                            })
                                                        })
                                                    </script>--}}
                                                    <div class="nk-widget-stream mt-10" id="stream-{{$k}}">
                                                        <span class="nk-widget-stream-status bg-success"></span>
                                                        <div class="nk-widget-stream-name">
                                                            <a href="#" data-toggle="collapse" data-target="#video-{{$k}}">FB Live Stream</a>
                                                        </div>
                                                    </div>
                                                    <div id="video-{{$k}}" class="collapse">
                                                        <div class="responsive-embed responsive-embed-16x9">
                                                            <iframe src="https://www.facebook.com/plugins/video.php?href={{$stream->link}}" height="350" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true"></iframe>
                                                        </div>
                                                    </div>
                                            @endif
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