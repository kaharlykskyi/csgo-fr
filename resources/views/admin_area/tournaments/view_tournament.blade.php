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
                        <img src="{{asset('assets/images/news_img/' . $tournament->banner_image)}}" alt="{{$tournament->title}}">
                    </div>
                    <div class="nk-gap-1"></div>
                    <h1 class="nk-post-title h4">{{$tournament->title}}</h1>

                    <div class="nk-post-by">
                        by <a href="#">{{ $tournament->author }}</a> in {{ $tournament->publication_date }}
                    </div>

                    <div class="nk-gap"></div>

                    {!! $tournament->content_tournament !!}

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

                                        @else
                                var autoCompleteData = {
                                        teams : [["Devon", ""],["", ""]],
                                        results : []
                                    };
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

                    <div class="nk-gap"></div>
                    <div class="nk-post-share">
                        <span class="h5">Share Tournament:</span>

                        <ul class="nk-social-links-2">
                            <li><span class="nk-social-facebook" title="Share page on Facebook" data-share="facebook"><span class="fab fa-facebook"></span></span></li>
                            <li><span class="nk-social-google-plus" title="Share page on Google+" data-share="google-plus"><span class="fab fa-google-plus"></span></span></li>
                            <li><span class="nk-social-twitter" title="Share page on Twitter" data-share="twitter"><span class="fab fa-twitter"></span></span></li>
                            <li><span class="nk-social-pinterest" title="Share page on Pinterest" data-share="pinterest"><span class="fab fa-pinterest-p"></span></span></li>

                            <!-- Additional Share Buttons
                                <li><span class="nk-social-linkedin" title="Share page on LinkedIn" data-share="linkedin"><span class="fab fa-linkedin"></span></span></li>
                                <li><span class="nk-social-vk" title="Share page on VK" data-share="vk"><span class="fab fa-vk"></span></span></li>
                            -->
                        </ul>
                    </div>
                </div>
                <!-- END: Post Text -->
            </div>
            <!-- END: Post -->

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
    </div>

    <!-- START: Page Background -->

    <img class="nk-page-background-top" src="{{ asset('images/bg-top.png') }}" alt="">
    <img class="nk-page-background-bottom" src="{{ asset('images/bg-bottom.png') }}" alt="">

    <!-- END: Page Background -->

@endsection