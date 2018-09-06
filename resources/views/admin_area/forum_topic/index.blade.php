@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'All forum topics'])

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
                            <th>Name topic</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($topics as $val)
                            <tr>
                                <td><p>{{$val->title}}</p></td>
                                <td style="display: flex;justify-content: space-around;">
                                    <a class="btn btn-primary mb-2" href="{{route('admin.forum-topic.edit',$val->id)}}" role="button">Edit</a>

                                    <form onsubmit="if(confirm('DELETE?')){return true}else{return false}"
                                          action="{{route('admin.forum-topic.destroy',$val->id)}}" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input class="btn btn-danger" type="submit" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr scope="row">
                                <th colspan="4"><h2 class="text-center">Not added topics</h2></th>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3">
                                <ul class="pagination">
                                    {{$topics->links()}}
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