<!-- BREADCRUMB-->
<section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                        <div class="au-breadcrumb-left">
                            <ul style="font-weight: 600;" class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a class="text-white" href="{{route('home')}}">{{__('Home')}}</a>
                                </li>
                                @if(isset($type))
                                    <li class="list-inline-item seprate">
                                        <span class="fa fa-angle-right"></span>
                                    </li>
                                    <li class="list-inline-item text-white text-capitalize">{{str_replace('_',' ',$type)}}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END BREADCRUMB-->