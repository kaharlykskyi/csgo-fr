@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'All news'])

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
                            <th>Title</th>
                            <th>Short title</th>
                            <th>Date publish</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($news as $val)
                                <tr>
                                    <td><h3>{{$val->title}}</h3></td>
                                    <td><h3>{{$val->short_title}}</h3></td>
                                    <td>{{$val->publication_date}}</td>
                                    <td style="display: flex;justify-content: space-around;">
                                        <a class="btn btn-primary mb-2" href="{{route('admin.news.edit',$val->id)}}" role="button">Edit</a>

                                        <a class="btn btn-warning mb-2" href="{{route('admin.news.show',$val->id)}}" role="link" target="_blank">View</a>

                                        <form onsubmit="if(confirm('DELETE?')){return true}else{return false}"
                                              action="{{route('admin.news.destroy',$val->id)}}" method="post">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input class="btn btn-danger" type="submit" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr scope="row">
                                    <th colspan="4"><h2 class="text-center">Not news</h2></th>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3">
                                <ul class="pagination">
                                    {{$news->links()}}
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