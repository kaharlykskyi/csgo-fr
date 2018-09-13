@extends('admin_area.layouts.admin')

@section('content')

    @component('admin_area.component.breadcrumb',['title'=>'','parent'=>'Dashboard','active' =>'Manage Announcement'])

    @endcomponent

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 m-t-30">
                <div class="card">
                    <div class="card-header">
                        <strong>Announcement</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{route('announcement')}}" method="post" class="form-horizontal">
                            @csrf

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="editor" class=" form-control-label">Announcement string</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <textarea id="editor" name="content" rows="9" placeholder="Content..." class="form-control" required>
                                        @if(isset($announcement)){{$announcement}}@else{{old('content')}}@endif
                                    </textarea>
                                    @if ($errors->has('content'))
                                        <small class="form-text text-danger">{{ $errors->first('content') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i>

                                    {{__('Save')}}

                                </button>
                            </div>

                            <script>
                                CKEDITOR.replace('editor',options);
                            </script>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection