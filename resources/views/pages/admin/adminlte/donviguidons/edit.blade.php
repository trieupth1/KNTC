@extends('pages.admin.' . config('view.admin') . '.layout.application', ['menu' => 'donviguidons'] )

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
    Donviguidons
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\DonviguidonController@index') !!}"><i class="fa fa-files-o"></i> Donviguidons</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $donviguidon->id }}</li>
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

    <form action="@if($isNew) {!! action('Admin\DonviguidonController@store') !!} @else {!! action('Admin\DonviguidonController@update', [$donviguidon->id]) !!} @endif" method="POST" enctype="multipart/form-data">
        @if( !$isNew ) <input type="hidden" name="_method" value="PUT"> @endif
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <a href="{!! URL::action('Admin\DonviguidonController@index') !!}" class="btn btn-block btn-default btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.back')</a>
                </h3>
            </div>
            <div class="box-body">
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('sokyhieu')) has-error @endif">
                                <label for="sokyhieu">@lang('admin.pages.donviguidons.columns.sokyhieu')</label>
                                <input type="text" class="form-control" id="sokyhieu" name="sokyhieu" required value="{{ old('sokyhieu') ? old('sokyhieu') : $donviguidon->sokyhieu }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('ngaybanhanh')) has-error @endif">
                                <label for="ngaybanhanh">@lang('admin.pages.donviguidons.columns.ngaybanhanh')</label>
                                <input type="text" class="form-control" id="ngaybanhanh" name="ngaybanhanh" required value="{{ old('ngaybanhanh') ? old('ngaybanhanh') : $donviguidon->ngaybanhanh }}">
                            </div>
                        </div>
                    </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="is_enabled">@lang('admin.pages.common.label.is_enabled')</label>
                            <div class="switch">
                                <input id="is_enabled" name="is_enabled" value="1" @if( $donviguidon->is_enabled) checked @endif class="cmn-toggle cmn-toggle-round-flat" type="checkbox">
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
