<aside class="menu-sidebar2">
    <div class="logo">
        <a href="{{route('admin.dashboard')}}">
            <img src="{{asset('admin-content/images/icon/logo-white.png')}}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar2__content js-scrollbar1">
        <div class="account2">
            <h4 class="name">{{ Auth::user()->name }}</h4>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <li class="active">
                    <a class="js-arrow" href="{{route('admin.dashboard')}}" onclick="document.location.href ='{{route('admin.dashboard')}}'"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        Manage Home page
                        <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('announcement')}}"></i>Manage Announcement</a>
                        </li>
                    </ul>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('admin.banner-image.index')}}"></i>Manage Banner Images</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        Manage news
                        <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('admin.news.create')}}"></i>Create news</a>
                        </li>
                        <li>
                            <a href="{{route('admin.news.index')}}">All news</a>
                        </li>
                        <li>
                            <a href="{{route('admin.news-category.create')}}"></i>Create category</a>
                        </li>
                        <li>
                            <a href="{{route('admin.news-category.index')}}">All categories</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        Manage tournaments
                        <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('admin.tournaments.create')}}"></i>Create tournaments</a>
                        </li>
                        <li>
                            <a href="{{route('admin.tournaments.index')}}">All tournaments</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        Manage matches
                        <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('admin.matches.create')}}"></i>Create match</a>
                        </li>
                        <li>
                            <a href="{{route('admin.matches.index')}}">All matches</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        Manage streams
                        <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('admin.streams.create')}}"></i>Create stream</a>
                        </li>
                        <li>
                            <a href="{{route('admin.streams.index')}}">All streams</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        Manage players
                        <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('admin.players.create')}}"></i>Create player</a>
                        </li>
                        <li>
                            <a href="{{route('admin.players.index')}}">All players</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        Manage teams
                        <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('admin.teams.create')}}"></i>Create team</a>
                        </li>
                        <li>
                            <a href="{{route('admin.teams.index')}}">All teams</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        Manage Forum Threads
                        <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('admin.forum-topic.create')}}"></i>Create Forum Thread</a>
                        </li>
                        <li>
                            <a href="{{route('admin.forum-topic.index')}}">All Forum Threads</a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        Manage Galleries
                        <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                    </a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="{{route('admin.gallery.create')}}"></i>Create Gallery</a>
                        </li>
                        <li>
                            <a href="{{route('admin.gallery.index')}}">All Galleries</a>
                        </li>
                        <li>
                            <a href="{{route('admin.image.create')}}"></i>Add Image</a>
                        </li>
                        <li>
                            <a href="{{route('admin.image.index')}}">All Images</a>
                        </li>
                        <li>
                            <a href="{{route('admin.video.create')}}"></i>Add Video</a>
                        </li>
                        <li>
                            <a href="{{route('admin.video.index')}}">All Video</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>