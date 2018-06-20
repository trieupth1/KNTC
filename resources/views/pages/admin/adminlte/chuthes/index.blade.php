@extends('pages.admin.' . config('view.admin') . '.layout.application', ['menu' => 'chuthes'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
<script src="{!! \URLHelper::asset('js/delete_item.js', 'admin/adminlte') !!}"></script>
@stop

@section('title')
@stop

@section('header')
Chuthes
@stop

@section('breadcrumb')
<li class="active">Chuthes</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="box-title">
                    <p class="text-right">
                        <a href="{!! action('Admin\ChutheController@create') !!}" class="btn btn-block btn-primary btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.create')</a>
                    </p>
                </h3>
                <br>
                <p style="display: inline-block;">@lang('admin.pages.common.label.search_results', ['count' => $count])</p>
            </div>
            <div class="col-sm-6 wrap-top-pagination">
                <div class="heading-page-pagination">
                    {!! \PaginationHelper::render($paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'], $count, $paginate['baseUrl'], [], $count, 'shared.topPagination') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-body" style=" overflow-x: scroll; ">
        <table class="table table-bordered">
            <tr>
                <th style="width: 10px">{!! \PaginationHelper::sort('id', 'ID') !!}</th>
                <th>{!! \PaginationHelper::sort('ten', trans('admin.pages.chuthes.columns.ten')) !!}</th>
                <th>{!! \PaginationHelper::sort('email', trans('admin.pages.chuthes.columns.email')) !!}</th>
                <th>{!! \PaginationHelper::sort('socmt', trans('admin.pages.chuthes.columns.socmt')) !!}</th>
                <th>{!! \PaginationHelper::sort('noicapcmt', trans('admin.pages.chuthes.columns.noicapcmt')) !!}</th>
                <th>{!! \PaginationHelper::sort('ngaycapcmt', trans('admin.pages.chuthes.columns.ngaycapcmt')) !!}</th>
                <th>{!! \PaginationHelper::sort('gioi_tinh', trans('admin.pages.chuthes.columns.gioi_tinh')) !!}</th>
                <th>{!! \PaginationHelper::sort('phone', trans('admin.pages.chuthes.columns.phone')) !!}</th>
                <th>{!! \PaginationHelper::sort('ngay_sinh', trans('admin.pages.chuthes.columns.ngay_sinh')) !!}</th>
                <th>{!! \PaginationHelper::sort('dia_chi', trans('admin.pages.chuthes.columns.dia_chi')) !!}</th>
                <th>{!! \PaginationHelper::sort('loai_chu_the', trans('admin.pages.chuthes.columns.loai_chu_the')) !!}</th>
                <th>{!! \PaginationHelper::sort('hinhanh', trans('admin.pages.chuthes.columns.hinhanh')) !!}</th>
                <th>{!! \PaginationHelper::sort('languoidaidien', trans('admin.pages.chuthes.columns.languoidaidien')) !!}</th>

                <th style="width: 40px">{!! \PaginationHelper::sort('is_enabled', trans('admin.pages.common.label.is_enabled')) !!}</th>
                <th style="width: 40px">@lang('admin.pages.common.label.actions')</th>
            </tr>
            @foreach( $chuthes as $chuthe )
                <tr>
                    <td>{{ $chuthe->id }}</td>
               <td>{{ $chuthe->ten }}</td>
               <td>{{ $chuthe->email }}</td>
               <td>{{ $chuthe->socmt }}</td>
               <td>{{ $chuthe->noicapcmt }}</td>
               <td>{{ $chuthe->ngaycapcmt }}</td>
               <td>{{ $chuthe->gioi_tinh }}</td>
               <td>{{ $chuthe->phone }}</td>
               <td>{{ $chuthe->ngay_sinh }}</td>
               <td>{{ $chuthe->dia_chi }}</td>
               <td>{{ $chuthe->loai_chu_the }}</td>
               <td>{{ $chuthe->hinhanh }}</td>
               <td>{{ $chuthe->languoidaidien }}</td>

                    <td>
                        @if( $chuthe->is_enabled )
                            <span class="badge bg-green">@lang('admin.pages.common.label.is_enabled_true')</span>
                        @else
                            <span class="badge bg-red">@lang('admin.pages.common.label.is_enabled_false')</span>
                        @endif
                    </td>
                    <td>
                        <a href="{!! action('Admin\ChutheController@show', $chuthe->id) !!}" class="btn btn-block btn-primary btn-xs">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="btn btn-block btn-danger btn-xs delete-button" data-delete-url="{!! action('Admin\ChutheController@destroy', $chuthe->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="box-footer">
        {!! \PaginationHelper::render($paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'], $count, $paginate['baseUrl'], []) !!}
    </div>
</div>
@stop