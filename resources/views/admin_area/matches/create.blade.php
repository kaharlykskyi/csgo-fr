@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'Create match'])

    @endcomponent

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 m-t-30">
                <div class="card">
                    <div class="card-header">
                        <strong>Create</strong> Match
                    </div>
                    <div class="card-body card-block">

                        <div id="smallForm" class="form-horizontal">

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="match_day" class=" form-control-label">Match day</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="match_day" value="2018-08-30 14:45" name="match_day" placeholder="Match day" class="form-control form_datetime" required>
                                    @if ($errors->has('match_day'))
                                        <small class="form-text text-danger">{{ $errors->first('match_day') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="match_day" class=" form-control-label">Score</label>
                                </div>
                                <div class="col-12 col-md-9" id="score">
                                    <div data-holder-for="score"></div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="match_day" class=" form-control-label">Stream link</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <div data-holder-for="link"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Subforms library -->
                        <div style="display:none">
                            <div data-name="link" data-label="Links" class="product">
                                <input class="form-control m-b-5" placeholder="link stream" name="link">
                            </div>
                        </div>

                        <div style="display:none">
                            <div data-name="score" data-label="Score" class="product">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="team1">Team 1</span>
                                    </div>
                                    <input name="score_team1" type="text" class="form-control" value="0" placeholder="Score team 1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="team2">Team 2</span>
                                    </div>
                                    <input name="score_team2" type="text" class="form-control" value="0" placeholder="Score team 2">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" id="saveSmallForm" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                        </div>
                        <script type="text/javascript">
                            $(".form_datetime").datetimepicker({
                                todayBtn:  1,
                                autoclose: 1,
                                todayHighlight: 1,
                                startView: 2,
                                forceParse: 0,
                                format: 'yyyy-mm-dd hh:ii:ss'
                            });

                            var smallJson = {
                                "match_day": '2018-08-30 14:45',
                                "scoreArray": [
                                    {
                                        "score_team1": '2',
                                        "score_team2": '1'
                                    }
                                ],
                                "linkArray": [
                                    {
                                        "link": ""
                                    }
                                ]
                            };

                            $('#smallForm').jqDynaForm();
                            $('#smallForm').jqDynaForm('set', smallJson);
                            $('#saveSmallForm').click(function(){
                                var json = $('#smallForm').jqDynaForm('get');
                                var jsonText = JSON.stringify(json, null, "    ");

                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },

                                });

                                $.ajax({
                                    type: "POST",
                                    url: "{{route('admin.matches.store')}}",
                                    data: jsonText,
                                    contentType: "application/json",
                                    dataType: "json",
                                    success: function (data) {
                                        //alert(JSON.stringify(data, null, 4))
                                        id = JSON.parse(data);
                                        location.replace('/admin/matches/'+id+'/edit')
                                    },

                                });

                            });

                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection