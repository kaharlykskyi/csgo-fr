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
            @if(Auth::user()->id === $post->user_id)
                <div class="post-edit-wrapper">
                    <a href="#forum-reply" onclick="editPost({{$post->id}})">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                </div>
            @endif
        @endisset
        <div class="nk-forum-topic-author">
            @isset($users)
                @foreach($users as $user)
                    @if($user->id == $post->user_id)
                        @php
                            $name = $user->name;
                        @endphp
                        <a href="{{route('show_profile',$user->name)}}">
                            <img src="@if(isset($user->logo_user)){{asset('assets/images/user_avatar/'.$user->logo_user)}}@else{{asset('images/photo_not_available.png')}}@endif" alt="{{$user->name}}">
                        </a>
                        <div class="nk-forum-topic-author-name" title="{{$user->name}}">
                            <a class="@if($user->role === 'admin') text-danger @else text-success @endif" href="{{route('show_profile',$user->name)}}">{{$user->name}}</a>
                        </div>
                    @endif
                @endforeach
            @endisset
        </div>
        <div class="nk-forum-topic-content">
            {!! $post->text_post !!}
            <span class="nk-forum-topic-date">{{($post->edit === 'true') ?  __('Massage edit - ') . date('M d Y H:i',strtotime($post->updated_at)):''}}</span>
        </div>
        <div class="nk-forum-topic-footer pt-45">
            <div class="row">
                <div class="col-sm-8">
                    <p class="mb-2">@isset($post->sequence_number) @if((integer)$post->sequence_number === 0) {{__('#first massage')}} @else {{__('#'. $post->sequence_number.'reply')}} @endif @endisset</p>
                    <span class="nk-forum-topic-date">{{date('M d Y H:i',strtotime($post->created_at))}}</span><br>
                </div>
                <div class="col-sm-4">
                    <span class="nk-forum-action-btn">
                        <a href="#forum-reply" class="nk-anchor" onclick="addField({{$post->id}},'{{$name}}')"><span class="fa fa-reply"></span> Reply</a>
                    </span>
                </div>
            </div>
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
