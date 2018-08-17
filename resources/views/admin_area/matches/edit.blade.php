@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'Update match'])

    @endcomponent

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 m-t-30">
                <div class="card">
                    <div class="card-header">
                        <strong>Create</strong> Match
                    </div>
                    <div class="default-tab">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home"
                                   aria-selected="true">Match info</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-map" role="tab" aria-controls="nav-profile"
                                   aria-selected="false">Match map</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-team" role="tab" aria-controls="nav-profile"
                                   aria-selected="false">Match team</a>
                            </div>
                        </nav>
                        <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="card-body card-block">

                                    <div id="smallForm" class="form-horizontal">
                                        <input type="hidden" name="match_inf" value="true">
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="match_day" class=" form-control-label">Match day</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="match_day" value="{{$match->match_day}}" name="match_day" placeholder="Match day" class="form-control form_datetime" required>
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
                                            <i class="fa fa-dot-circle-o"></i> {{__('Save')}}
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
                                            "match_day": '{{ $match->match_day }}',
                                            "scoreArray":{!! $match->fin_score !!},
                                            "linkArray": {!! $match->stream_link !!}
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
                                                type: "PATCH",
                                                url: "{{route('admin.matches.update',$match->id)}}",
                                                data: jsonText,
                                                contentType: "application/json",
                                                dataType: "json",
                                                success: function (data) {
                                                    alert("DATA UPDATE")
                                                },
                                            });

                                        });

                                    </script>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="nav-map" role="tabpanel" aria-labelledby="nav-home-map">
                                <div class="card-body card-block">
                                    <div id="mapForm" class="form-horizontal">
                                        <input type="hidden" name="map" value="true">
                                        <div class="row form-group">
                                            <div class="col col-md-2">
                                                <label for="match_day" class=" form-control-label">Maps</label>
                                            </div>
                                            <div class="col-12 col-md-10">
                                                <div data-holder-for="map"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" id="saveMapForm" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> {{__('Save')}}
                                        </button>
                                    </div>

                                    <!-- Subforms library -->
                                    <div style="display:none">
                                        <div data-name="map" data-label="Map" class="product m-b-15">
                                            <div class="row">
                                                <div class="col-12 m-b-5">
                                                    <div class="input-group m-b-5">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text" for="map_name">Map</label>
                                                        </div>
                                                        <select class="custom-select" id="map_name" name="map_name">
                                                            <option value="inferno">Inferno</option>
                                                            <option value="Train">Train</option>
                                                            <option value="Mirage">Mirage</option>
                                                            <option value="Nuke">Nuke</option>
                                                            <option value="Overpass">Overpass</option>
                                                            <option value="Cache">Cache</option>
                                                            <option value="Dust II">Dust II</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 m-b-5">
                                                    <div class="input-group">
                                                           <span class="input-group-btn">
                                                             <a id="map_img" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                               <i class="fa fa-picture-o"></i> Choose
                                                             </a>
                                                           </span>
                                                        <input id="thumbnail" class="form-control" type="text" name="map_img">
                                                    </div>
                                                    <img id="holder" style="margin-top:15px;max-height:100px;">
                                                </div>
                                                <div class="col-6">
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group m-b-5">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="team1_ct">Team 1 CT</span>
                                                                    </div>
                                                                    <input id="team1_ct" name="team1_ct" type="text" class="form-control">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="team2_t">Team 2 T</span>
                                                                    </div>
                                                                    <input id="team2_t" name="team2_t" type="text" class="form-control">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-6">
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group m-b-5">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="team1_t">Team 1 T</span>
                                                                    </div>
                                                                    <input id="team1_t" name="team1_t" type="text" class="form-control">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="team2_ct">Team 2 CT</span>
                                                                    </div>
                                                                    <input id="team2_ct" name="team2_ct" type="text" class="form-control">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script type="text/javascript">

                                    var mapJson = {
                                        @if(isset($match->map))
                                        "mapArray": {!! $match->map  !!},
                                        @else
                                        "mapArray" : []
                                        @endif

                                    };

                                    $('#mapForm').jqDynaForm();
                                    $('#mapForm').jqDynaForm('set', mapJson);
                                    $('#saveMapForm').click(function(){
                                        var json = $('#mapForm').jqDynaForm('get');
                                        var jsonText = JSON.stringify(json, null, "    ");

                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },

                                        });

                                        $.ajax({
                                            type: "PATCH",
                                            url: "{{route('admin.matches.update',$match->id)}}",
                                            data: jsonText,
                                            contentType: "application/json",
                                            dataType: "json",
                                            success: function (data) {
                                                //alert("Information updated")
                                                alert(JSON.stringify(data, null, 4))
                                            },
                                        });

                                    });


                                    $('#map_img').filemanager('image');

                                </script>
                            </div>
                            <div class="tab-pane fade show" id="nav-team" role="tabpanel" aria-labelledby="nav-home-map">
                                <div class="card-body card-block">
                                    <div id="teamForm" class="form-horizontal">
                                        <input type="hidden" name="team" value="true">
                                        <div class="row form-group">
                                            <div class="col col-md-2">
                                                <label for="match_day" class=" form-control-label">Teams</label>
                                            </div>
                                            <div class="col-12 col-md-10">
                                                <div class="product m-b-15">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="team1">Team 1</span>
                                                                </div>
                                                                <input name="team_names1" type="text" class="form-control" placeholder="Team name" aria-describedby="team1">
                                                            </div>
                                                            <div class="m-b-5 m-t-5">
                                                                <div class="input-group">
                                                                   <span class="input-group-btn">
                                                                     <a id="logo1" data-input="thumbnaiTeam1" data-preview="holderTeam1" class="btn btn-primary">
                                                                       <i class="fa fa-picture-o"></i> Choose
                                                                     </a>
                                                                   </span>
                                                                    <input placeholder="Team logo" id="thumbnaiTeam1" class="form-control" type="text" name="team1_logo">
                                                                </div>
                                                                <img id="holderTeam1" style="margin-top:15px;max-height:100px;">
                                                            </div>
                                                            <div style="margin:10px; border-left:3px solid black" data-holder-for="team_users1"></div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="team1">Team 2</span>
                                                                </div>
                                                                <input name="team_names2" type="text" class="form-control" placeholder="Team name" aria-describedby="team1">
                                                            </div>
                                                            <div class="m-b-5 m-t-5">
                                                                <div class="input-group">
                                                                   <span class="input-group-btn">
                                                                     <a id="logo2" data-input="thumbnaiTeam2" data-preview="holderTeam2" class="btn btn-primary">
                                                                       <i class="fa fa-picture-o"></i> Choose
                                                                     </a>
                                                                   </span>
                                                                    <input placeholder="Team logo" id="thumbnaiTeam2" class="form-control" type="text" name="team2_logo">
                                                                </div>
                                                                <img id="holderTeam2" style="margin-top:15px;max-height:100px;">
                                                            </div>
                                                            <div style="margin:10px; border-left:3px solid black" data-holder-for="team_users2"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" id="saveTeamForm" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> {{__('Save')}}
                                        </button>
                                    </div>
                                </div>

                                <!-- Subforms library -->
                                <div style="display:none">
                                    <div data-name="team_users1" data-label="Team" class="product m-b-15">
                                        <table>
                                            <thead>Player info</thead>
                                            <tr>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="user_name">Name</span>
                                                    </div>
                                                    <input id="user_name" name="user_name" type="text" class="form-control">
                                                </div>
                                            </tr>
                                            <tr>
                                                <div class="input-group m-b-5 m-t-5">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="country">Country</label>
                                                    </div>
                                                    <select id="flags" name="country_id" class="form-control}}">
                                                        @if(isset($countries))
                                                            @foreach($countries as $country)
                                                                <option value="{{$country->country}}" data-class="avatar" data-style="background-image: url({!! asset('images/flag/'.$country->flag) !!});">{{$country->country}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div style="display:none">
                                    <div data-name="team_users2" data-label="Team" class="product m-b-15">
                                        <table>
                                            <thead>Player info</thead>
                                            <tr>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="user_name">Name</span>
                                                    </div>
                                                    <input id="user_name" name="user_name" type="text" class="form-control">
                                                </div>
                                            </tr>
                                            <tr>
                                                <div class="input-group m-b-5 m-t-5">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="country">Country</label>
                                                    </div>
                                                    <select id="flags" name="country_id" class="form-control}}">
                                                        @if(isset($countries))
                                                            @foreach($countries as $country)
                                                                <option value="{{$country->country}}" data-class="avatar" data-style="background-image: url({!! asset('images/flag/'.$country->flag) !!});">{{$country->country}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <script type="text/javascript">


                                            @if(isset($match->team))
                                    var teamJson = {!! $match->team  !!};
                                            @else
                                    var teamJson = {
                                            "team_names1" : "",
                                            "team_names2" : "",
                                            "team1_logo": "",
                                            "team2_logo": "",
                                            "team_users1Array": [{"user_name": "sdfdf", "country_id": "Albania"}]
                                        };
                                    @endif



                                    $('#teamForm').jqDynaForm();
                                    $('#teamForm').jqDynaForm('set', teamJson);
                                    $('#saveTeamForm').click(function(){
                                        var json = $('#teamForm').jqDynaForm('get');
                                        var jsonText = JSON.stringify(json, null, "    ");

                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },

                                        });

                                        $.ajax({
                                            type: "PATCH",
                                            url: "{{route('admin.matches.update',$match->id)}}",
                                            data: jsonText,
                                            contentType: "application/json",
                                            dataType: "json",
                                            success: function (data) {
                                                alert("Information updated")
                                                //alert(JSON.stringify(data, null, 4))
                                            },
                                        });

                                    });

                                    $('#logo1').filemanager('image');
                                    $('#logo2').filemanager('image');

                                </script>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection