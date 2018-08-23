@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'All matches'])

    @endcomponent

    <div class="container-fluid">
        <div class="row justify-content-center">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-12 m-t-30">
                <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Team</th>
                                <th>Final score</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($matches as $val)
                                <tr>
                                    <td><p>{{$val->match_day}}</p></td>
                                    <td>
                                        <p>
                                            @if(isset($val->team))
                                                <?php
                                                $team_data = json_decode($val->team);
                                                //print_r($team_data);
                                                echo $team_data->team_names1 . ' <strong>vs</strong> ' . $team_data->team_names2;
                                                ?>
                                            @endif
                                        </p>
                                    </td>
                                    <td>
                                        @if(isset($val->fin_score))
                                            <?php
                                                $score = json_decode($val->fin_score);
                                                echo $score[0]->score_team1 . ' : ' . $score[0]->score_team2;
                                            ?>
                                        @endif
                                    </td>
                                    <td style="display: flex;justify-content: space-around;">
                                        <a class="btn btn-primary mb-2" href="{{route('admin.matches.edit',$val->id)}}" role="button">Edit</a>

                                        <a class="btn btn-warning mb-2" href="{{route('admin.matches.show',$val->id)}}" role="link" target="_blank">View</a>

                                        <form onsubmit="if(confirm('DELETE?')){return true}else{return false}"
                                              action="{{route('admin.matches.destroy',$val->id)}}" method="post">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input class="btn btn-danger" type="submit" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr scope="row">
                                    <th colspan="4"><h2 class="text-center">Not matches</h2></th>
                                </tr>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3">
                                    <ul class="pagination">
                                        {{$matches->links()}}
                                    </ul>
                                </td>
                            </tr>
                            </tfoot>
                        </table>

                </div>
            </div>
        </div>
    </div>

@endsection