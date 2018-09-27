@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'All users'])

    @endcomponent

    <section>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- USER DATA-->
                        <div class="user-data m-b-40">
                            <h3 class="title-3 m-b-30">
                                <i class="zmdi zmdi-account-calendar"></i>user data</h3>
                            <div class="filters m-b-45">
                                <form class="form-header" action="{{route('admin.users')}}" method="POST">
                                    @csrf
                                    <input class="au-input au-input--xl" type="text" name="search" placeholder="Search users" required/>
                                    <button class="au-btn--submit" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button>
                                </form>
                                @isset($search)
                                    <div class="alert alert-info m-t-15" role="alert">
                                       Result for "{{$search}}" word!
                                    </div>
                                @endisset
                            </div>
                            <div class="table-responsive table-data">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>name</td>
                                            <td>role</td>
                                            <td>access</td>
                                            <td>moderators</td>
                                        </tr>
                                        </thead>
                                    <tbody>
                                        @component('admin_area.users.component.user_data',['users' => $users])

                                        @endcomponent
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">
                                                <ul class="pagination">
                                                    {{$users->links()}}
                                                </ul>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- END USER DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function accses_user(id,url){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

            });

            $.ajax({
                url:  url,
                type: "POST",
                data: $('#user-' + id).serialize(),
                success: function(response) {
                    if (response.access) {
                        alert(response.access);
                    } else {
                        alert(response);
                    }
                },
                error: function(response) {
                    alert('Error');
                    console.log(response);
                }
            });
        }

        function moderators_user(id,url){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

            });

            $.ajax({
                url: url,
                type: "POST",
                data: $('#user-moderators-' + id).serialize(),
                success: function(response) {
                    if (response.access) {
                        alert(response.access);
                    } else {
                        alert(response);
                    }
                },
                error: function(response) {
                    alert('Error');
                    console.log(response);
                }
            });
        }
    </script>
    <!-- END PAGE CONTAINER-->

@endsection