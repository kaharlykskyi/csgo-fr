@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'All tournaments'])

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

                    @component('admin_area.component.show_resource',[
                        'data'=> $tournaments,
                        'mass' => 'Not tournaments',
                        'edit_rout' => 'admin.tournaments.edit',
                        'view_rout' => 'admin.tournaments.show',
                        'delete_rout' => 'admin.tournaments.destroy',
                    ])
                    @endcomponent

                </div>
            </div>
        </div>
    </div>

@endsection