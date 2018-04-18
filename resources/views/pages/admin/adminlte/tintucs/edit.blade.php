@extends('pages.admin.' . config('view.admin') . '.layout.application', ['menu' => 'tintucs'] )

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
            $("#image_i-image").change(function (event) {
                $("#image_i-image-preview").attr("src", URL.createObjectURL(event.target.files[0]));
            });
        });
    </script>
@stop

@section('title')
@stop

@section('header')
    Tintucs
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\TintucController@index') !!}"><i class="fa fa-files-o"></i> Tintucs</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $tintuc->id }}</li>
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

    <form action="@if($isNew) {!! action('Admin\TintucController@store') !!} @else {!! action('Admin\TintucController@update', [$tintuc->id]) !!} @endif" method="POST" enctype="multipart/form-data">
        @if( !$isNew ) <input type="hidden" name="_method" value="PUT"> @endif
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <a href="{!! URL::action('Admin\TintucController@index') !!}" class="btn btn-block btn-default btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.back')</a>
                </h3>
            </div>
            <div class="box-body">
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('tieu_de')) has-error @endif">
                                <label for="tieu_de">@lang('admin.pages.tintucs.columns.tieu_de')</label>
                                <input type="text" class="form-control" id="tieu_de" name="tieu_de" required value="{{ old('tieu_de') ? old('tieu_de') : $tintuc->tieu_de }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ngay_dang">@lang('admin.pages.tintucs.columns.ngay_dang')</label>
                                <div class="input-group date datetime-field">
                                    <input type="text" class="form-control" name="ngay_dang" required
                                         value="{{ old('ngay_dang') ? old('ngay_dang') : $tintuc->ngay_dang }}">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('the_loai')) has-error @endif">
                                <label for="the_loai">@lang('admin.pages.tintucs.columns.the_loai')</label>
                                <input type="text" class="form-control" id="the_loai" name="the_loai" required value="{{ old('the_loai') ? old('the_loai') : $tintuc->the_loai }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('nguon_tin')) has-error @endif">
                                <label for="nguon_tin">@lang('admin.pages.tintucs.columns.nguon_tin')</label>
                                <input type="text" class="form-control" id="nguon_tin" name="nguon_tin" required value="{{ old('nguon_tin') ? old('nguon_tin') : $tintuc->nguon_tin }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                @if( !empty($tintuc->image) )
                                    <img id="image-preview"  style="max-width: 500px; width: 100%;" src="{!! $tintuc->present()->image->present()->url !!}" alt="" class="margin" />
                                @else
                                    <img id="image-preview" style="max-width: 500px; width: 100%;" src="{!! \URLHelper::asset('img/no_image.jpg', 'common') !!}" alt="" class="margin" />
                                @endif
                                <input type="file" style="display: none;"  id="image" name="image">
                                <p class="help-block" style="font-weight: bolder;">
                                    @lang('admin.pages.tintucs.columns.image_id')
                                    <label for="image" style="font-weight: 100; color: #549cca; margin-left: 10px; cursor: pointer;">@lang('admin.pages.common.buttons.edit')</label>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('tom_tat')) has-error @endif">
                                <label for="tom_tat">@lang('admin.pages.tintucs.columns.tom_tat')</label>
                                <input type="text" class="form-control" id="tom_tat" name="tom_tat" required value="{{ old('tom_tat') ? old('tom_tat') : $tintuc->tom_tat }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('noi_dung')) has-error @endif">
                                <label for="noi_dung">@lang('admin.pages.tintucs.columns.noi_dung')</label>
                                <textarea name="noi_dung" class="form-control" rows="5" required placeholder="@lang('admin.pages.tintucs.columns.noi_dung')">{{ old('noi_dung') ? old('noi_dung') : $tintuc->noi_dung }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('trang_thai')) has-error @endif">
                                <label for="trang_thai">@lang('admin.pages.tintucs.columns.trang_thai')</label>
                                <input type="text" class="form-control" id="trang_thai" name="trang_thai" required value="{{ old('trang_thai') ? old('trang_thai') : $tintuc->trang_thai }}">
                            </div>
                        </div>
                    </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="is_enabled">@lang('admin.pages.common.label.is_enabled')</label>
                            <div class="switch">
                                <input id="is_enabled" name="is_enabled" value="1" @if( $tintuc->is_enabled) checked @endif class="cmn-toggle cmn-toggle-round-flat" type="checkbox">
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
