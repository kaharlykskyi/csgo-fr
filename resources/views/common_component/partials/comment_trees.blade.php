@forelse($comments as $comment)
    <!-- START: Comment -->
    <div class="nk-comment" @isset($child)style="margin-left: 30px;"@endisset id="post-{{$comment->id}}">
        <div class="nk-comment-meta">
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
                @if(Auth::user()->role === 'admin')
                    <a href="{{route('delete_comment',['id' => $comment->id,'link' => Route::current()->getName()])}}" class="float-right nk-color-danger mr-10"><i class="fa fa-trash" aria-hidden="true"></i></a>
                @endif
                @if(Auth::user()->id == $comment->user_id)
                    <a href="#comment-form" class="float-right nk-color-danger mr-10" onclick="edit({{$comment->id}},'{{route('edit_comment')}}','{{Route::current()->getName()}}')">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                @endif
            @endauth
        </div>
        <div class="nk-comment-text">
            <div class="comment-content">
                {!! $comment->comment !!}
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