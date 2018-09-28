@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'Settings'])

    @endcomponent

    <section>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card m-t-15">
                            <div class="card-header">
                                <strong>Settings</strong> site
                            </div>
                            <div class="card-body card-block">
                                <form action="{{route('settings')}}" method="post" class="form-horizontal">

                                    @csrf

                                    @isset($settings)
                                        @foreach($settings as $setting)
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="{{$setting->name}}" class=" form-control-label">{{str_replace('_',' ',$setting->name)}}</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="{{$setting->name}}" name="{{$setting->name}}" value="{{$setting->value}}" class="form-control">
                                                </div>
                                            </div>
                                        @endforeach
                                    @endisset

                                    <button type="submit" class="btn btn-primary btn-sm m-t-15">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END PAGE CONTAINER-->

@endsection