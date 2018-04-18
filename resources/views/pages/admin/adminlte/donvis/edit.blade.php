@extends('pages.admin.' . config('view.admin') . '.layout.application', ['menu' => 'donvis'] )

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
    Donvis
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\DonviController@index') !!}"><i class="fa fa-files-o"></i> Donvis</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $donvi->id }}</li>
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

    <form action="@if($isNew) {!! action('Admin\DonviController@store') !!} @else {!! action('Admin\DonviController@update', [$donvi->id]) !!} @endif" method="POST" enctype="multipart/form-data">
        @if( !$isNew ) <input type="hidden" name="_method" value="PUT"> @endif
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <a href="{!! URL::action('Admin\DonviController@index') !!}" class="btn btn-block btn-default btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.back')</a>
                </h3>
            </div>
            <div class="box-body">
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('tendonvi')) has-error @endif">
                                <label for="tendonvi">@lang('admin.pages.donvis.columns.tendonvi')</label>
                                <input type="text" class="form-control" id="tendonvi" name="tendonvi" required value="{{ old('tendonvi') ? old('tendonvi') : $donvi->tendonvi }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('tructhuoccap')) has-error @endif">
                                <label for="tructhuoccap">@lang('admin.pages.donvis.columns.tructhuoccap')</label>
                                <input type="text" class="form-control" id="tructhuoccap" name="tructhuoccap" required value="{{ old('tructhuoccap') ? old('tructhuoccap') : $donvi->tructhuoccap }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('diachi')) has-error @endif">
                                <label for="diachi">@lang('admin.pages.donvis.columns.diachi')</label>
                                <input type="text" class="form-control" id="diachi" name="diachi" required value="{{ old('diachi') ? old('diachi') : $donvi->diachi }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('phone')) has-error @endif">
                                <label for="phone">@lang('admin.pages.donvis.columns.phone')</label>
                                <input type="text" class="form-control" id="phone" name="phone" required value="{{ old('phone') ? old('phone') : $donvi->phone }}">
                            </div>
                        </div>
                    </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="is_enabled">@lang('admin.pages.common.label.is_enabled')</label>
                            <div class="switch">
                                <input id="is_enabled" name="is_enabled" value="1" @if( $donvi->is_enabled) checked @endif class="cmn-toggle cmn-toggle-round-flat" type="checkbox">
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
