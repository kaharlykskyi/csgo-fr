@foreach($posts as $post)
    <li class="@isset($children){{__('mt-5')}}@endisset post-wrapper" id="post-{{$post->id}}">
        @isset(Auth::user()->role)
            @if(Auth::user()->role == 'admin')
                <div class="post-delete-wrapper">
                    <a href="{{route('post_delete',$post->id)}}" onclick="if(confirm('DELETE?')){return true}else{return false}">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </div>
            @endif
        @endisset
        <div class="nk-forum-topic-author">
            @isset($users)
                @foreach($users as $user)
                    @if($user->id == $post->user_id)
                        <a href="{{route('show_profile',$user->name)}}">
                            <img src="@if(isset($user->logo_user)){{asset('assets/images/user_avatar/'.$user->logo_user)}}@else{{asset('images/photo_not_available.png')}}@endif" alt="{{$user->name}}">
                        </a>
                        <div class="nk-forum-topic-author-name" title="{{$user->name}}">
                            <a href="{{route('show_profile',$user->name)}}">{{$user->name}}</a>
                        </div>
                        <div class="nk-forum-topic-author-role">{{$user->role}}</div>
                        <div class="nk-forum-topic-author-since">
                            Member since <br> {{date('M d Y',strtotime($user->created_at))}}
                        </div>
                    @endif
                @endforeach
            @endisset
        </div>
        <div class="nk-forum-topic-content">
            {!! $post->text_post !!}
        </div>
        <div class="nk-forum-topic-footer">
            <span class="nk-forum-topic-date">{{date('M d Y',strtotime($post->created_at))}}</span>

            <span class="nk-forum-action-btn">
            <a href="#forum-reply" class="nk-anchor" onclick="addField({{$post->id}})"><span class="fa fa-reply"></span> Reply</a>
        </span>
        </div>
    </li>
    @if(count($post->children) > 0)
        @include('forum.partials.posts_treas', [
            'posts' => $post->children,
            'children' => true,
            'users' => $users
        ])
    @endif
@endforeach
