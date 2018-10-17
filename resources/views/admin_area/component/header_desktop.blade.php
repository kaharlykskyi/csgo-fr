<header class="header-desktop2">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap2">
                <div class="logo d-block d-lg-none">
                    <a href="#">
                        <img src="{{asset('admin-content/images/icon/logo-white.png')}}" alt="CoolAdmin" />
                    </a>
                </div>
                <div class="header-button2">
                    <div class="header-button-item mr-0 js-sidebar-btn">
                        <i class="zmdi zmdi-menu"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
    <div class="logo">
        <a href="#">
            <img src="{{asset('admin-content/images/icon/logo-white.png')}}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar2__content js-scrollbar2">
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <li class="active has-sub">
                    <a class="js-arrow" href="{{route('admin.dashboard')}}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard
                    </a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        </i>Manage news
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
                            <a href="{{route('admin.tournaments.create')}}">Create tournament</a>
                        </li>
                        <li>
                            <a href="{{route('admin.tournaments.index')}}">All tournaments</a>
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
                            <a href="{{route('admin.streams.create')}}">Create stream</a>
                        </li>
                        <li>
                            <a href="{{route('admin.streams.index')}}">All streams</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>