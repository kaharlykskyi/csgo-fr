@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'All streams'])

    @endcomponent

    <div class="container">
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
                            <th>Streamen name</th>
                            <th>Show homepage</th>
                            <th>Streamer link</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($streams as $val)
                            <tr>
                                <td><p>{{ str_limit($val->name, 20, ' (...)')}}</p></td>
                                <td><p>{{ $val->show_homepage }}</p></td>
                                <td><p>{{ $val->link }}</p></td>
                                <td style="display: flex;justify-content: space-around;">
                                    <a class="btn btn-primary mb-2 mr-2" href="{{route('admin.streams.edit',$val->id)}}" role="button">Edit</a>

                                    <form onsubmit="if(confirm('DELETE?')){return true}else{return false}"
                                          action="{{route('admin.streams.destroy',$val->id)}}" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input class="btn btn-danger" type="submit" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr scope="row">
                                <th colspan="4"><h2 class="text-center">{{ __('No streams added')  }}</h2></th>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3">
                                <ul class="pagination">
                                    {{$streams->links()}}
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