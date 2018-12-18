@forelse($comments as $comment)
    <!-- START: Comment -->
    <div class="nk-comment" @isset($child)style="margin-left: 30px;"@endisset id="post-{{$comment->id}}">
        <div class="nk-comment-meta">
            @foreach($users as $user)
                @if($user->id == $comment->user_id)
                    @php
                        $delete = true;
                        $user_id = $user->id;
                        if($user->moderators === 'super_admin'){
                            $delete = false;
                        }
                    @endphp
                    <a href="{{route('show_profile',$user->name)}}">
                        <img class="comment-logo" src="@if(isset($user->logo_user)){{asset('assets/images/user_avatar/'.$user->logo_user)}}@else{{asset('images/photo_not_available.png')}}@endif" alt="">
                    </a>
                @endif
            @endforeach
            by
            @foreach($users as $user)
                @if($user->id == $comment->user_id)
                    <a href="{{route('show_profile',$user->name)}}">
                        {{$user->name}}
                    </a>
                @endif
            @endforeach
            in {{$comment->created_at}}
            <a href="#comment-form"
               onclick="reply({{$comment->id}},'@foreach($users as $user) @if($user->id == $comment->user_id){{$user->name}}@endif @endforeach')"
               class="nk-btn nk-btn-rounded nk-btn-color-dark-3 float-right">Reply</a>
            @auth
                @if($comment->moder === 'false' || Auth::user()->moderators !== 'user')
                        @if(Auth::user()->role === 'admin' && ($delete || Auth::user()->moderators === 'super_admin') || $user_id == Auth::user()->id )
                            <a href="{{route('delete_comment',['id' => $comment->id,'link' => Route::current()->getName()])}}" class="float-right nk-color-danger mr-10"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        @endif
                        @if((Auth::user()->id == $comment->user_id || Auth::user()->role === 'admin') && ($delete || Auth::user()->moderators === 'super_admin'))
                            <a href="#comment-form" class="float-right nk-color-danger mr-10" onclick="edit({{$comment->id}},'{{route('edit_comment')}}','{{Route::current()->getName()}}')">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                        @endif
                @endif

                    @if(Auth::user()->role === 'admin' && ($delete || Auth::user()->moderators === 'super_admin'))
                        <p class="float-right nk-color-danger mr-10">
                            <input type="checkbox" style="display: none;" class="cbx"
                                   @if($comment->moder === 'true') checked @endif
                                   name="status" id="comment{{$comment->id}}"
                                   onchange="moderStatus({{$comment->id}},'{{Route::current()->getName()}}')">
                            <label for="comment{{$comment->id}}" class="check" title="take moder status">
                                <svg width="18px" height="18px" viewBox="0 0 18 18">
                                    <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                    <polyline points="1 9 7 14 15 4"></polyline>
                                </svg>
                            </label>
                        </p>
                    @endif
            @endauth
        </div>
        <div class="nk-comment-text">
            <div class="comment-content">
                @if($comment->moder === 'false' || Auth::user()->moderators !== 'user')
                    {!! $comment->comment !!}
                @else
                    <div class="alert alert-warning" role="alert">
                        {{__('Comment on moderation')}}
                    </div>
                @endif

                @isset($comment->moder_id)
                    <div class="row">
                        <div class="col-12">
                            <em class="small">Moder by
                                @foreach($users as $user)
                                    @if($user->id == $comment->user_id)
                                        <a href="{{route('show_profile',$user->name)}}">
                                            {{$user->name}}
                                        </a>
                                    @endif
                                @endforeach
                                in {{$comment->updated_at}}
                            </em>
                        </div>
                    </div>
                @endisset
            </div>
            <div class="row justify-content-end mt-2">
                <div class="col-1 @if((int)$comment->like_count > 0){{__('text-success')}}@elseif((int)$comment->like_count < 0){{__('text-danger')}}@endif" id="comment-{{$comment->id}}">
                    {{$comment->like_count}}
                </div>
                @guest

                @else
                    <div class="col-2">
                        <button type="button" class="btn btn-outline-success btn-sm" onclick="like(1,{{$comment->id}})">+</button>
                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="like(-1,{{$comment->id}})">-</button>
                    </div>
                @endguest
                <script>
                    function like(increment,id) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: '{{$url}}',
                            type: 'POST',
                            data: "increment="+increment+"&id="+id,
                            success: function(data){
                                $('#comment-' + id).html(data);
                            },
                            error: function (data) {
                                alert(data.responseJSON.message);
                                console.log(data);
                            }
                        });
                    }

                </script>
            </div>
        </div>
        @if(count($comment->children) > 0)
            @include('common_component.partials.comment_trees', [
                'comments' => $comment->children,
                'child' => true,
            ])
        @endif
    </div>
    <!-- END: Comment -->
@empty
@endforelse