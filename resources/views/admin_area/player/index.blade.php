@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'All players'])

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
                            <th>NickName</th>
                            <th>Team</th>
                            <th>Country</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($players as $val)
                            <tr>
                                <td><p>{{$val->nickname}}</p></td>
                                <td><p>{{$val->team_id}}</p></td>
                                <td>
                                    @if(isset($val->country))
                                        @foreach($countries as $country)
                                            @if($country->country == $val->country)
                                                <img class="mr-3" src="{{ asset('images/flag/' . $country->flag) }}" alt="{{$val->country}}">
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td style="display: flex;justify-content: space-around;">
                                    <a class="btn btn-primary mb-2" href="{{route('admin.players.edit',$val->id)}}" role="button">Edit</a>

                                    <a class="btn btn-warning mb-2 disabled" href="{{route('admin.players.show',$val->id)}}" role="link" target="_blank">View</a>

                                    <form onsubmit="if(confirm('DELETE?')){return true}else{return false}"
                                          action="{{route('admin.players.destroy',$val->id)}}" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input class="btn btn-danger" type="submit" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr scope="row">
                                <th colspan="4"><h2 class="text-center">Not players</h2></th>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3">
                                <ul class="pagination">
                                    {{$players->links()}}
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