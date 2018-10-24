@extends('admin_area.layouts.admin')

@section('content')

        @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>''])

        @endcomponent

        <!-- STATISTIC-->
        <section class="statistic">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <a href="{{route('admin.users')}}" style="width: 100%;">
                                <div class="statistic__item">
                                    <h2 class="number">
                                        {{\Illuminate\Support\Facades\DB::table('users')->count()}}
                                    </h2>
                                    <span class="desc">Users</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <a href="{{route('settings')}}" style="width: 100%;">
                                <div class="statistic__item">
                                    <h2 class="number">

                                    </h2>
                                    <span class="desc">Settings site</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-settings"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <a href="{{route('announcement')}}" style="width: 100%;">
                                <div class="statistic__item">
                                    <h2 class="number">

                                    </h2>
                                    <span class="desc">Manage Announcement</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-calendar-note"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <a href="{{route('admin.banner-image.index')}}" style="width: 100%;">
                                <div class="statistic__item" >
                                    <h2 class="number">

                                    </h2>
                                    <span class="desc">Manage Banner Images</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-blur-linear"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END STATISTIC-->

@endsection