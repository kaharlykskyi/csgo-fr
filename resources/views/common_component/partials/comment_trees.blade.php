@forelse($comments as $comment)
    <!-- START: Comment -->
    <div class="nk-comment" @isset($child)style="margin-left: 30px;"@endisset>
        <div class="nk-comment-meta">
            by
            @foreach($users as $user)
                @if($user->id == $comment->user_id)
                    <a href="#">
                        {{$user->name}}
                    </a>
                @endif
            @endforeach
            in {{$comment->created_at}}
            <a href="#comment-form"
               onclick="reply({{$comment->id}},'@foreach($users as $user) @if($user->id == $comment->user_id){{$user->name}}@endif @endforeach')"
               class="nk-btn nk-btn-rounded nk-btn-color-dark-3 float-right">Reply</a>
        </div>
        <div class="nk-comment-text">
            {!! $comment->comment !!}
            <div class="row justify-content-end mt-2">
                <div class="col-1" id="comment-{{$comment->id}}">
                    {{$comment->like_count}}
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-outline-success btn-sm" onclick="like(1,{{$comment->id}})">+</button>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="like(-1,{{$comment->id}})">-</button>
                </div>
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
                                alert(data.statusText);
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