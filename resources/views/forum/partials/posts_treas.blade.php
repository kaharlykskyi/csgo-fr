@foreach($posts as $post)
    <li class="@isset($children){{__('mt-5')}}@endisset post-wrapper" id="post-{{$post->id}}">
        @isset(Auth::user()->role)
            @isset($users)
                @foreach($users as $user)
                    @if($user->id == $post->user_id)
                        @if(Auth::user()->role == 'admin' && ($user->moderators !== 'super_admin' || Auth::user()->moderators == 'super_admin'))
                            <div class="post-delete-wrapper">
                                <a href="{{route('post_delete',$post->id)}}" onclick="if(confirm('DELETE?')){return true}else{return false}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </div>
                        @endif
                    @endif
                @endforeach
            @endisset

                @isset($users)
                    @foreach($users as $user)
                        @if($user->id == $post->user_id)
                            @if(((Auth::user()->id === $post->user_id && $post->moder === 'false') || Auth::user()->role == 'admin') || (Auth::user()->role == 'admin' && ($user->moderators !== 'super_admin' || Auth::user()->moderators == 'super_admin')))
                                <div class="post-edit-wrapper">
                                    <a href="#forum-reply" onclick="editPost({{$post->id}})">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                </div>
                            @endif
                        @endif
                    @endforeach
                @endisset

                @isset($users)
                    @foreach($users as $user)
                        @if($user->id == $post->user_id)
                            @if(Auth::user()->role == 'admin' && ($user->moderators !== 'super_admin' || Auth::user()->moderators == 'super_admin'))
                                <div class="post-edit-wrapper" style="top: 65px;">
                                    <input type="checkbox" style="display: none;" class="cbx"
                                           @if($post->moder === 'true') checked @endif
                                           name="status" id="post{{$post->id}}"
                                           onchange="moderStatus({{$post->id}})">
                                    <label for="post{{$post->id}}" class="check" title="take moder status">
                                        <svg width="18px" height="18px" viewBox="0 0 18 18">
                                            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                            <polyline points="1 9 7 14 15 4"></polyline>
                                        </svg>
                                    </label>
                                </div>
                            @endif
                        @endif
                    @endforeach
                @endisset

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
            @if($post->moder === 'false' || Auth::user()->moderators !== 'user')
                {!! $post->text_post !!}
            @else
                <div class="alert alert-warning" role="alert">
                    {{__('Post on moderation')}}
                </div>
            @endif

        </div>
        <div class="nk-forum-topic-footer pt-45">
            <em class="nk-forum-topic-date">{{($post->edit === 'true') ?  __('Massage edit - ') . date('M d Y H:i',strtotime($post->updated_at)):''}}</em>
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
@endforeach
