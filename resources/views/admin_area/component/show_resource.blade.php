<table class="table table-borderless table-striped table-earning">
    <thead>
    <tr>
        <th>Title</th>
        <th>Date publish</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @forelse($data as $val)
        <tr>
            <td><p>{{ str_limit($val->title, 20, ' (...)')}}</p></td>
            <td>{{$val->publication_date}}</td>
            <td style="display: flex;justify-content: space-around;">
                <a class="btn btn-primary mb-2" href="{{route($edit_rout,$val->id)}}" role="button">Edit</a>

                <a class="btn btn-warning mb-2" href="{{route($view_rout,$val->id)}}" role="link" target="_blank">View</a>

                <form onsubmit="if(confirm('DELETE?')){return true}else{return false}"
                      action="{{route($delete_rout,$val->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <input class="btn btn-danger" type="submit" value="Delete">
                </form>
            </td>
        </tr>
    @empty
        <tr scope="row">
            <th colspan="4"><h2 class="text-center">{{ $mass  }}</h2></th>
        </tr>
    @endforelse
    </tbody>
    <tfoot>
    <tr>
        <td colspan="3">
            <ul class="pagination">
                {{$data->links()}}
            </ul>
        </td>
    </tr>
    </tfoot>
</table>
