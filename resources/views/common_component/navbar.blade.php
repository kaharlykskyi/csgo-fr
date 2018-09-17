<nav class="nk-navbar nk-navbar-top nk-navbar-sticky nk-navbar-autohide">
    <div class="container">
        <div class="nk-nav-table">

            <a style="width: 100px;"  href="{{route('home')}}" class="nk-nav-logo">
                <img src="{{ asset('images/logo.png') }}" alt="GoodGames" width="199" class="mr-20">
            </a>

            <ul class="nk-nav nk-nav-center d-none d-lg-table-cell" data-nav-mobile="#nk-nav-mobile">

                <li>
                    <a href="{{route('forum_topics')}}">
                        Forum
                    </a>
                </li>
                <li>
                    <a href="{{route('latest_matches')}}">
                        Matches
                    </a>
                </li>
                <li>
                    <a href="{{route('all_news')}}">
                        News
                    </a>
                </li>
                <li>
                    <a href="{{route('gallery')}}">
                        Gallery

                    </a>
                </li>
                <li>
                    <a href="{{route('all_tournaments')}}">
                        Tournaments
                    </a>
                </li>

                @guest
                    <li>
                        <a href="#" data-toggle="modal" data-target="#modalLogin">
                            {{ __('Login') }}
                        </a>
                    </li>
                @endguest
            </ul>
            <ul class="nk-nav nk-nav-right nk-nav-icons">

                <li class="single-icon d-lg-none">
                    <a href="#" class="no-link-effect" data-nav-toggle="#nk-nav-mobile">
                                <span class="nk-icon-burger">
                                    <span class="nk-t-1"></span>
                                    <span class="nk-t-2"></span>
                                    <span class="nk-t-3"></span>
                                </span>
                    </a>
                </li>


            </ul>
        </div>
    </div>
</nav>