@extends('layouts.app')

@section('content')

    <?php
    $streams = json_decode($match_data->stream_link);
    $maps = json_decode($match_data->map);
    $score = json_decode($match_data->fin_score);
    ?>

    <div class="nk-gap-2"></div>
    <div class="row vertical-gap">
        <div class="col-lg-8">

            @component('matches.component.breadcrumb',['type' => $type_match])

            @endcomponent

            <div class="nk-match">
                <div class="nk-match-team-left">
                    <a class="logo-team-block" href="#">
                        @if(isset($team->team1))
                            <span class="nk-match-team-logo">
                                <img src="@if(isset($team->team1->logo)){{asset($team->team1->logo)}}@else{{asset('images/obama_meme_by_zcoogerchannel-d4xo8rx.png')}}@endif" alt="{{$team->team1->name}}">
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
                    <a class="logo-team-block" href="#">
                        @if(isset($team->team2))
                            <span class="nk-match-team-logo">
                                <img src="@if(isset($team->team2->logo)){{asset($team->team2->logo)}}@else{{asset('images/obama_meme_by_zcoogerchannel-d4xo8rx.png')}}@endif" alt="{{$team->team2->name}}">
                            </span>
                        @endif
                        @isset($team->team2)
                            <span class="nk-match-team-name">
                                {{$team->team2->name}}
                            </span>
                        @endisset
                    </a>
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
                        @forelse($team->players_team2 as $user)

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

                        @empty

                        @endforelse
                    </div>
                </div>
            </div>

            <div class="nk-gap-2"></div>

            <div class="team-content maps">
                @if(isset($maps))
                    @foreach($maps as $map)
                        <div class="row">
                            <div class="col-12">
                                @isset($map->map_name)
                                    <p class="h4 text-center">{{$map->map_name}}</p>
                                @endisset
                            </div>
                            <div class="col-2 text-center">
                                <span class="@if($map->team1_t > $map->team2_ct){{__('text-success')}}@else{{__('text-danger')}}@endif">T {{$map->team1_t}}</span><br>
                                <span class="@if($map->team1_ct > $map->team2_t){{__('text-success')}}@else{{__('text-danger')}}@endif">CT {{$map->team1_ct}}</span>
                                <p class="h3 @if(((integer)$map->team1_ct + (integer)$map->team1_t) > ((integer)$map->team2_ct + (integer)$map->team2_t))
                                    {{__('text-success')}}
                                @else
                                    {{__('text-danger')}}
                                @endif">{{(integer)$map->team1_ct + (integer)$map->team1_t}}</p>
                            </div>
                            <div class="col-8">
                                @if(isset($map->map_img))
                                    <img src="{{asset($map->map_img)}}" alt="">
                                @endif
                            </div>
                            <div class="col-2 text-center">
                                <span class="@if($map->team1_t < $map->team2_ct){{__('text-success')}}@else{{__('text-danger')}}@endif">CT {{$map->team2_ct}}</span><br>
                                <span class="@if($map->team1_ct < $map->team2_t){{__('text-success')}}@else{{__('text-danger')}}@endif">T {{$map->team2_t}}</span>
                                <p class="h3 @if(((integer)$map->team2_ct + (integer)$map->team2_t) > ((integer)$map->team1_ct + (integer)$map->team1_t))
                                {{__('text-success')}}
                                @else
                                {{__('text-danger')}}
                                @endif">{{(integer)$map->team2_ct + (integer)$map->team2_t}}</p>
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

                @isset($tournament->title)
                    <div class="team-content">
                        <p class="h4">Tournament</p>
                        <div class="row">
                            <div class="col-12">
                                <p style="color: #dd163b;">{{$tournament->title}}</p>
                            </div>
                        </div>
                    </div>
                @endisset

            <div class="nk-gap-2"></div>

                @isset($streams)
                    <div class="team-content">
                        <p class="h4">Stream links</p>
                        <div class="row">

                            @foreach($streams as $stream)
                                <div class="col-12">
                                    <a href="{{$stream->link}}">{{$stream->link}}</a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endisset

            <div class="nk-gap-2"></div>
            <!-- START: Comments -->
            <div id="comments"></div>
            <h3 class="nk-decorated-h-2"><span><span class="text-main-1">@if($count != 0){{$count}}@else{{__('')}}@endif</span> Comments</span></h3>
            <div class="nk-gap"></div>
            <div class="nk-comments">

                @forelse($comments as $comment)
                <!-- START: Comment -->
                    <div class="nk-comment">
                        <div class="nk-comment-meta">
                            by
                            @foreach($users as $user)
                                @if($user->id == $comment->user_id)
                                    <a href="#">
                                        {{$user->name}}
                                    </a>
                                @endif
                            @endforeach
                            in {{$comment->created_at}}
                        </div>
                        <div class="nk-comment-text">
                            <p>{{$comment->comment}}</p>
                        </div>
                    </div>
                    <!-- END: Comment -->
                @empty
                @endforelse
                <ul class="pagination">
                    {{$comments->links()}}
                </ul>

            </div>

            <!-- START: Reply -->
            <div class="nk-gap-2"></div>
            <h3 class="nk-decorated-h-2"><span><span class="text-main-1">Leave</span> a Reply</span></h3>
            <div class="nk-gap"></div>
            <div class="nk-reply">
                <form action="{{route('match_comment')}}" method="post" class="nk-form" novalidate="novalidate">
                    @csrf
                    @if(isset(Auth::user()->id))
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    @endif
                    <input type="hidden" name="match_id" value="{{$match_data->id}}">
                    <textarea class="form-control required" name="comment" rows="5" placeholder="Message *" aria-required="true"></textarea>
                    <div class="nk-gap-1"></div>
                    @if (session('status'))
                        <div style="display: block;" class="nk-form-response-error">{{ session('status') }}</div>
                    @endif
                    <button type="submit" class="nk-btn nk-btn-rounded nk-btn-color-main-1">Post Comment</button>
                </form>
            </div>
            <!-- END: Reply -->
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
        @component('common_component.sidebar',['streams' => $streams_output])

        @endcomponent
        <!-- END: Sidebar -->
        </div>
    </div>

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top-5.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->

@endsection