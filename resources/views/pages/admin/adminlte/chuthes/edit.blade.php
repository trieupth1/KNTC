@extends('pages.admin.' . config('view.admin') . '.layout.application', ['menu' => 'chuthes'] )

@section('metadata')
@stop

@section('styles')
    <link rel="stylesheet" href="{!! \URLHelper::asset('libs/datetimepicker/css/bootstrap-datetimepicker.min.css', 'admin') !!}">
@stop

@section('scripts')
    <script src="{{ \URLHelper::asset('libs/moment/moment.min.js', 'admin') }}"></script>
    <script src="{{ \URLHelper::asset('libs/datetimepicker/js/bootstrap-datetimepicker.min.js', 'admin') }}"></script>
    <script>
        $('.datetime-field').datetimepicker({'format': 'YYYY-MM-DD HH:mm:ss', 'defaultDate': new Date()});

        $(document).ready(function () {
            
        });
    </script>
@stop

@section('title')
@stop

@section('header')
    Chuthes
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\ChutheController@index') !!}"><i class="fa fa-files-o"></i> Chuthes</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $chuthe->id }}</li>
    @endif
@stop

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="@if($isNew) {!! action('Admin\ChutheController@store') !!} @else {!! action('Admin\ChutheController@update', [$chuthe->id]) !!} @endif" method="POST" enctype="multipart/form-data">
        @if( !$isNew ) <input type="hidden" name="_method" value="PUT"> @endif
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <a href="{!! URL::action('Admin\ChutheController@index') !!}" class="btn btn-block btn-default btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.back')</a>
                </h3>
            </div>
            <div class="box-body">
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('ten')) has-error @endif">
                                <label for="ten">@lang('admin.pages.chuthes.columns.ten')</label>
                                <input type="text" class="form-control" id="ten" name="ten" required value="{{ old('ten') ? old('ten') : $chuthe->ten }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('email')) has-error @endif">
                                <label for="email">@lang('admin.pages.chuthes.columns.email')</label>
                                <input type="text" class="form-control" id="email" name="email" required value="{{ old('email') ? old('email') : $chuthe->email }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('socmt')) has-error @endif">
                                <label for="socmt">@lang('admin.pages.chuthes.columns.socmt')</label>
                                <input type="text" class="form-control" id="socmt" name="socmt" required value="{{ old('socmt') ? old('socmt') : $chuthe->socmt }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('noicapcmt')) has-error @endif">
                                <label for="noicapcmt">@lang('admin.pages.chuthes.columns.noicapcmt')</label>
                                <input type="text" class="form-control" id="noicapcmt" name="noicapcmt" required value="{{ old('noicapcmt') ? old('noicapcmt') : $chuthe->noicapcmt }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('ngaycapcmt')) has-error @endif">
                                <label for="ngaycapcmt">@lang('admin.pages.chuthes.columns.ngaycapcmt')</label>
                                <input type="text" class="form-control" id="ngaycapcmt" name="ngaycapcmt" required value="{{ old('ngaycapcmt') ? old('ngaycapcmt') : $chuthe->ngaycapcmt }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('gioi_tinh')) has-error @endif">
                                <label for="gioi_tinh">@lang('admin.pages.chuthes.columns.gioi_tinh')</label>
                                <input type="text" class="form-control" id="gioi_tinh" name="gioi_tinh" required value="{{ old('gioi_tinh') ? old('gioi_tinh') : $chuthe->gioi_tinh }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('phone')) has-error @endif">
                                <label for="phone">@lang('admin.pages.chuthes.columns.phone')</label>
                                <input type="text" class="form-control" id="phone" name="phone" required value="{{ old('phone') ? old('phone') : $chuthe->phone }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('ngay_sinh')) has-error @endif">
                                <label for="ngay_sinh">@lang('admin.pages.chuthes.columns.ngay_sinh')</label>
                                <input type="text" class="form-control" id="ngay_sinh" name="ngay_sinh" required value="{{ old('ngay_sinh') ? old('ngay_sinh') : $chuthe->ngay_sinh }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('dia_chi')) has-error @endif">
                                <label for="dia_chi">@lang('admin.pages.chuthes.columns.dia_chi')</label>
                                <input type="text" class="form-control" id="dia_chi" name="dia_chi" required value="{{ old('dia_chi') ? old('dia_chi') : $chuthe->dia_chi }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('loai_chu_the')) has-error @endif">
                                <label for="loai_chu_the">@lang('admin.pages.chuthes.columns.loai_chu_the')</label>
                                <input type="text" class="form-control" id="loai_chu_the" name="loai_chu_the" required value="{{ old('loai_chu_the') ? old('loai_chu_the') : $chuthe->loai_chu_the }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('hinhanh')) has-error @endif">
                                <label for="hinhanh">@lang('admin.pages.chuthes.columns.hinhanh')</label>
                                <input type="text" class="form-control" id="hinhanh" name="hinhanh" required value="{{ old('hinhanh') ? old('hinhanh') : $chuthe->hinhanh }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('languoidaidien')) has-error @endif">
                                <label for="languoidaidien">@lang('admin.pages.chuthes.columns.languoidaidien')</label>
                                <input type="text" class="form-control" id="languoidaidien" name="languoidaidien" required value="{{ old('languoidaidien') ? old('languoidaidien') : $chuthe->languoidaidien }}">
                            </div>
                        </div>
                    </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="is_enabled">@lang('admin.pages.common.label.is_enabled')</label>
                            <div class="switch">
                                <input id="is_enabled" name="is_enabled" value="1" @if( $chuthe->is_enabled) checked @endif class="cmn-toggle cmn-toggle-round-flat" type="checkbox">
                                <label for="is_enabled"></label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.save')</button>
            </div>
        </div>
    </form>
@stop
