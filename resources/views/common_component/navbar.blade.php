<nav class="nk-navbar nk-navbar-top nk-navbar-sticky nk-navbar-autohide">
    <div class="container">
        <div class="nk-nav-table">

            <a style="width: 100px;"  href="{{route('home')}}" class="nk-nav-logo">
                <img src="{{ asset('images/logo.png') }}" alt="GoodGames" width="199">
            </a>

            <ul class="nk-nav nk-nav-right d-none d-lg-table-cell" data-nav-mobile="#nk-nav-mobile">

                <li>
                    <a href="{{route('forum_topics')}}">
                        Forum
                    </a>
                </li>
                <li class=" nk-drop-item">
                    <a href="blog-list.html">
                        Blog

                    </a><ul class="dropdown">

                        <li>
                            <a href="news.html">
                                News

                            </a>
                        </li>
                        <li class=" nk-drop-item">
                            <a href="blog-grid.html">
                                Blog With Sidebar

                            </a><ul class="dropdown">

                                <li>
                                    <a href="blog-grid.html">
                                        Blog Grid

                                    </a>
                                </li>
                                <li>
                                    <a href="blog-list.html">
                                        Blog List

                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="blog-fullwidth.html">
                                Blog Fullwidth

                            </a>
                        </li>
                        <li>
                            <a href="blog-article.html">
                                Blog Article

                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('gallery')}}">
                        Gallery

                    </a>
                </li>
                <li class=" nk-drop-item">
                    <a href="tournaments.html">
                        Tournaments

                    </a><ul class="dropdown">

                        <li>
                            <a href="tournaments.html">
                                Tournament

                            </a>
                        </li>
                        <li>
                            <a href="tournaments-teams.html">
                                Teams

                            </a>
                        </li>
                        <li>
                            <a href="tournaments-teammate.html">
                                Teammate

                            </a>
                        </li>
                    </ul>
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