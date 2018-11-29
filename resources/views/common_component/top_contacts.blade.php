<div class="nk-contacts-top">
    <div class="container">
        <div class="nk-contacts-left">
            <ul class="nk-social-links">
                <li><a class="nk-social-rss" href="#"><span class="fa fa-rss"></span></a></li>
                <li><a class="nk-social-twitch" href="#"><span class="fab fa-twitch"></span></a></li>
                <li><a class="nk-social-steam" href="#"><span class="fab fa-steam"></span></a></li>
                <li><a class="nk-social-facebook" href="#"><span class="fab fa-facebook"></span></a></li>
                <li><a class="nk-social-google-plus" href="#"><span class="fab fa-google-plus"></span></a></li>
                <li><a class="nk-social-twitter" href="https://twitter.com/nkdevv" target="_blank"><span class="fab fa-twitter"></span></a></li>
                <li><a class="nk-social-pinterest" href="#"><span class="fab fa-pinterest-p"></span></a></li>
            </ul>
        </div>
        <div class="nk-contacts-right">
            <ul class="nk-contacts-icons">

                <li>
                    <span id="change-theme">
                        <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
                    </span>
                </li>
                <li>
                    <a href="#" data-toggle="modal" data-target="#modalSearch">
                        <span class="fa fa-search"></span>
                    </a>
                </li>


                @guest
                        <a href="#" data-toggle="modal" data-target="#modalLogin">
                            <span class="fa fa-user"></span>
                        </a>

                @else
                    <li>
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div style="z-index: 100000;" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                {{ __('Profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('all_chats') }}">
                                {{ __('Chats ') }}
                                @php
                                    $new_mass = DB::table('chat_masseges')->where([
                                        ['user2',Auth::user()->id],
                                        ['seen2',0]
                                    ])->count();
                                @endphp
                                @if($new_mass !== 0)
                                    <span class="nk-badge">{{$new_mass}}</span>
                                @endif
                            </a>
                            @if(Auth::user()->role == 'admin')
                                <a class="dropdown-item" href="{{route('admin.dashboard')}}">
                                    {{ __('Admin') }}
                                </a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li>
                        <span class="nk-cart-toggle">
                            <span class="fa fa-envelope-o"></span>
                            <span class="nk-badge">{{$new_mass}}</span>
                        </span>
                        @php
                            $mass_data = DB::table('chat_masseges')
                                    ->where([['user2',Auth::user()->id],['seen2',0]])
                                    ->join('users','chat_masseges.user','=','users.id')
                                    ->select('users.name','chat_masseges.massage','chat_masseges.created_at')->get();
                        @endphp
                        <div class="nk-cart-dropdown">
                            @isset($mass_data)
                                @forelse($mass_data as $item)
                                    <div class="nk-widget-post pl-10" onclick="location.href = '{{route('send_massage',$item->name)}}'" style="cursor:pointer;">
                                        <h3 class="nk-post-title mb-0">
                                            <a href="{{route('send_massage',$item->name)}}">{{strip_tags(str_limit($item->massage,50,' ...'))}}</a>
                                        </h3>
                                        <span class="nk-post-by">{{$item->name}}</span><span>{{$item->created_at}}</span>
                                    </div>
                                @empty
                                    <div class="nk-widget-post pl-10">
                                        <h3 class="nk-post-title">
                                            <a href="#">{{__('No massages')}}</a>
                                        </h3>
                                    </div>
                                @endforelse
                            @endisset
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</div>
