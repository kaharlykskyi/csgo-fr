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
                        <div class="default-tab">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home"
                                       aria-selected="true">Tournament Info</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile"
                                       aria-selected="false">Tournament Brackets</a>
                                </div>
                            </nav>

                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <form action="{{route('admin.tournaments.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        @csrf

                                        @include('admin_area.tournaments.partrials.form')
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <p>Save tournament. After you will can create <strong>Tournament Brackets</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection