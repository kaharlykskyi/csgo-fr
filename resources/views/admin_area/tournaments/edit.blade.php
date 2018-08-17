@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'Edit tournament'])

    @endcomponent

    <div class="container">
        <div class="row justify-content-center">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-12 m-t-30">
                <div class="card">
                    <div class="card-header">
                        <strong>Edit</strong> Tournament
                    </div>
                    <div class="card-body card-block">
                        <div class="default-tab">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home"
                                       aria-selected="true">Tournament Info</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile"
                                       aria-selected="false">Tournament Brackets</a>
                                </div>
                            </nav>
                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <form action="{{route('admin.tournaments.update',$tournament->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <input type="hidden" name="_method" value="put">
                                        @csrf

                                        @include('admin_area.tournaments.partrials.form')
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="alert alert-info m-t-5 m-b-5" role="alert">
                                        Saved automatically!
                                    </div>
                                    <div id="brackets">
                                    </div>
                                    <script>
                                        @if(isset($tournament->tournament_metadata))
                                            var autoCompleteData = {!! $tournament->tournament_metadata !!}

                                         @else
                                            var autoCompleteData = {
                                                    teams : [["Devon", ""],["", ""]],
                                                    results : []
                                                }
                                        @endif

                                        function edit_fn(container, data, doneCb) {
                                            var input = $('<input type="text">')
                                            input.val(data ? data.flag + ':' + data.name : '')
                                            container.html(input)
                                            input.focus()
                                            input.blur(function() {
                                                var inputValue = input.val()
                                                if (inputValue.length === 0) {
                                                    doneCb(null); // Drop the team and replace with BYE
                                                } else {
                                                    var flagAndName = inputValue.split(':') // Expects correct input
                                                    doneCb({flag: flagAndName[0], name: flagAndName[1]})
                                                }
                                            })
                                        }

                                        function saveFn(data) {
                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },

                                            });

                                            $.ajax({
                                                type: "PATCH",
                                                url: "{{route('admin.tournaments.update',$tournament->id)}}",
                                                data: JSON.stringify(data),
                                                contentType: "application/json",
                                                dataType: "json",
                                                success: function (data) {
                                                    alert(data);
                                                },

                                            });

                                        }

                                        function render_fn(container, data, score, state) {
                                            switch(state) {
                                                case "empty-bye":
                                                    container.append("No team")
                                                    return;
                                                case "empty-tbd":
                                                    container.append("Upcoming")
                                                    return;

                                                case "entry-no-score":
                                                case "entry-default-win":
                                                case "entry-complete":
                                                    container.append('<img src="{{asset('images/flag')}}/'+data.flag+'.png" /> ').append(data.name)
                                                    return;
                                            }
                                        }


                                            $('#brackets').bracket({
                                                init: autoCompleteData,
                                                save: saveFn,
                                                decorator: {edit: edit_fn,
                                                    render: render_fn}})

                                    </script>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection