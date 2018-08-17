@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'Create tournament'])

    @endcomponent

    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <strong>Create</strong> Tournament
                </div>
                <div class="card-body card-block">
                    <div class="col-12 m-t-30">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <form action="{{route('admin.tournaments.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                @csrf

                                @include('admin_area.tournaments.partrials.form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection