@extends('layouts.app')

@section('content')
    <div class="row vertical-gap">
        <div class="col-lg-8">

    @component('admin_area.tournaments.component.breadcrumb',['title' => 'Tournaments'])

    @endcomponent
        <?php
            $team = json_decode($match->team);
            $streams = json_decode($match->stream_link);
            dump($team);
        ?>

    <!-- START: Now Playing -->
        <div class="nk-match">
            <div class="nk-match-team-left">
                <a href="#">
                        <span class="nk-match-team-logo">
                            <img src="{{$team->team1_logo}}" alt="">
                        </span>
                    <span class="nk-match-team-name">
                            {{$team->team_names1}}
                        </span>
                </a>
            </div>
            <div class="nk-match-status">
                <a href="#">
                    <span class="nk-match-status-vs">VS</span>
                    <span> : </span>
                </a>
            </div>
            <div class="nk-match-team-right">
                <a href="#">
                        <span class="nk-match-team-name">
                            {{$team->team_names2}}
                        </span>
                    <span class="nk-match-team-logo">
                            <img src="{{$team->team2_logo}}" alt="">
                        </span>
                </a>
            </div>
        </div>

        @foreach($streams as $stream)

            <div class="responsive-embed responsive-embed-16x9 mb-5">
                <iframe width="560" height="315" src="{{$stream->link}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>

        @endforeach
        <!-- END: Now Playing -->

        <!-- START: Match Description -->
        <div class="nk-gap-2"></div>
        <h3 class="h4">Something wrong?</h3>
        <p>He made his passenger captain of one, with four of the men; and himself, his mate, and five more, went in the other; and they contrived their business very well, for they came up to the ship about midnight. I cannot express what a satisfaction it was to me to come into my old hutch</p>
        <!-- END: Match Description -->

        </div>

        <div class="col-lg-4">
            <!--
                START: Sidebar

                Additional Classes:
                    .nk-sidebar-left
                    .nk-sidebar-right
                    .nk-sidebar-sticky
            -->
        @component('common_component.sidebar')

        @endcomponent
        <!-- END: Sidebar -->
        </div>


        <!-- START: Page Background -->

        <img class="nk-page-background-top" src="{{ asset('images/bg-top.png') }}" alt="">
        <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

        <!-- END: Page Background -->
    </div>
@endsection