@extends('layouts.app')

@section('content')
    <div class="row vertical-gap">
        <div class="col-lg-8">

        @component('admin_area.tournaments.component.breadcrumb',['title' => $tournament->title])

        @endcomponent

        <!-- START: Post -->
            <div class="nk-blog-post nk-blog-post-single">
                <!-- START: Post Text -->
                <div class="nk-post-text mt-0">
                    <div class="nk-post-img">
                        <img src="{{asset('assets/images/tournament_img/' . $tournament->banner_image)}}" alt="{{$tournament->title}}">
                    </div>
                    <div class="nk-gap-1"></div>
                    <h1 class="nk-post-title h4">{{$tournament->title}}</h1>

                    <div class="nk-post-by">
                        by <a href="#">{{ $tournament->author }}</a> in {{ $tournament->publication_date }}
                    </div>

                    <div class="nk-gap"></div>

                    {!! $tournament->content_tournament !!}

                    @isset($tournament->tournament_metadata)
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 m-b-5 m-t-5">
                                    <p class="h3">Tournament Brackets</p>
                                </div>
                                <div class="col-12">
                                    <div id="brackets">
                                    </div>
                                </div>
                            </div>
                            <script>
                                @if(isset($tournament->tournament_metadata))
                                    var autoCompleteData = {!! $tournament->tournament_metadata !!};
                                @endif

                                function edit_fn(container, data, doneCb) {
                                    var input = $('<input type="text">')
                                    input.val(data ? data.flag + ':' + data.name : '')
                                    container.html(input)
                                    input.focus()
                                    input.blur(function() {
                                        var inputValue = input.val()
                                        if (inputValue.length === 0) {
                                            doneCb(null); // Drop the team and replace with BYE
                                        } else {
                                            var flagAndName = inputValue.split(':') // Expects correct input
                                            doneCb({flag: flagAndName[0], name: flagAndName[1]})
                                        }
                                    })
                                }

                                function render_fn(container, data, score, state) {
                                    switch(state) {
                                        case "empty-bye":
                                            container.append("No team");
                                            return;
                                        case "empty-tbd":
                                            container.append("Upcoming");
                                            return;

                                        case "entry-no-score":
                                        case "entry-default-win":
                                        case "entry-complete":
                                            container.append('<img src="{{asset('images/flag')}}/'+data.flag+'.png" /> ').append(data.name)
                                            return;
                                    }
                                }

                                jQuery('#brackets').bracket({
                                    init: autoCompleteData,
                                    decorator: {edit: edit_fn,
                                        render: render_fn},
                                    teamWidth: 150,
                                    matchMargin: 20
                                })
                            </script>
                        </div>
                    @endisset

                    <div class="nk-gap"></div>
                </div>
                <!-- END: Post Text -->
            </div>
            <!-- END: Post -->

            <div class="nk-gap-2"></div>
            <!-- START: Comments -->
                @component('common_component.comments_output',[
                    'comments' => $comments,
                    'count' => $count,
                    'users' => $users,
                    'object' => $tournament,
                    'url' => route('tournament_comment_like'),
                    'url_comment' => route('tournament_comment')
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