@extends('pages.admin.' . config('view.admin') . '.layout.application', ['menu' => 'vanbans'] )

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
Văn Bản
@stop

@section('breadcrumb')
<li class="active">Văn Bản</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="row">
            <form method="GET" action="" enctype="multipart/form-data">

                @include('pages.admin.adminlte.vanbans.filter')

            </form>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h3 class="box-title">
                    <p class="text-right">
                        <a href="{!! action('Admin\VanbanController@create') !!}" class="btn btn-block btn-primary btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.create')</a>
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
                <th>{!! \PaginationHelper::sort('ten', trans('admin.pages.vanbans.columns.ten')) !!}</th>
                <th>{!! \PaginationHelper::sort('so_hieu', trans('admin.pages.vanbans.columns.so_hieu')) !!}</th>
                <th>{!! \PaginationHelper::sort('trich_dan', trans('admin.pages.vanbans.columns.trich_dan')) !!}</th>
                <th>{!! \PaginationHelper::sort('ngay_ban_hanh', trans('admin.pages.vanbans.columns.ngay_ban_hanh')) !!}</th>
                <th>{!! \PaginationHelper::sort('ngay_nhan', trans('admin.pages.vanbans.columns.ngay_nhan')) !!}</th>
                <th>{!! \PaginationHelper::sort('loai_van_ban', trans('admin.pages.vanbans.columns.loai_van_ban')) !!}</th>
                <th>{!! \PaginationHelper::sort('nguoi_ky', trans('admin.pages.vanbans.columns.nguoi_ky')) !!}</th>

                <th style="width: 40px">{!! \PaginationHelper::sort('is_enabled', trans('admin.pages.common.label.is_enabled')) !!}</th>
                <th style="width: 40px">@lang('admin.pages.common.label.actions')</th>
            </tr>
            @foreach( $vanbans as $vanban )
                <tr>
                    <td>{{ $vanban->id }}</td>
               <td>{{ $vanban->ten }}</td>
               <td>{{ $vanban->so_hieu }}</td>
               <td>{{ $vanban->trich_dan }}</td>
               <td>{{ $vanban->ngay_ban_hanh }}</td>
               <td>{{ $vanban->ngay_nhan }}</td>
               <td>{{ $vanban->loai_van_ban }}</td>
               <td>{{ $vanban->nguoi_ky }}</td>

                    <td>
                        @if( $vanban->is_enabled )
                            <span class="badge bg-green">@lang('admin.pages.common.label.is_enabled_true')</span>
                        @else
                            <span class="badge bg-red">@lang('admin.pages.common.label.is_enabled_false')</span>
                        @endif
                    </td>
                    <td>
                        <a href="{!! action('Admin\VanbanController@show', $vanban->id) !!}" class="btn btn-block btn-primary btn-xs">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="btn btn-block btn-danger btn-xs delete-button" data-delete-url="{!! action('Admin\VanbanController@destroy', $vanban->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
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