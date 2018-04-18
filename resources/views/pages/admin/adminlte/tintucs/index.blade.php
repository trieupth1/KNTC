@extends('pages.admin.' . config('view.admin') . '.layout.application', ['menu' => 'tintucs'] )

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
Tintucs
@stop

@section('breadcrumb')
<li class="active">Tintucs</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="box-title">
                    <p class="text-right">
                        <a href="{!! action('Admin\TintucController@create') !!}" class="btn btn-block btn-primary btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.create')</a>
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
                <th>{!! \PaginationHelper::sort('tieu_de', trans('admin.pages.tintucs.columns.tieu_de')) !!}</th>
                <th>{!! \PaginationHelper::sort('ngay_dang', trans('admin.pages.tintucs.columns.ngay_dang')) !!}</th>
                <th>{!! \PaginationHelper::sort('the_loai', trans('admin.pages.tintucs.columns.the_loai')) !!}</th>
                <th>{!! \PaginationHelper::sort('nguon_tin', trans('admin.pages.tintucs.columns.nguon_tin')) !!}</th>
                <th>{!! \PaginationHelper::sort('tom_tat', trans('admin.pages.tintucs.columns.tom_tat')) !!}</th>
                <th>{!! \PaginationHelper::sort('trang_thai', trans('admin.pages.tintucs.columns.trang_thai')) !!}</th>

                <th style="width: 40px">{!! \PaginationHelper::sort('is_enabled', trans('admin.pages.common.label.is_enabled')) !!}</th>
                <th style="width: 40px">@lang('admin.pages.common.label.actions')</th>
            </tr>
            @foreach( $tintucs as $tintuc )
                <tr>
                    <td>{{ $tintuc->id }}</td>
               <td>{{ $tintuc->tieu_de }}</td>
               <td>{{ $tintuc->ngay_dang }}</td>
               <td>{{ $tintuc->the_loai }}</td>
               <td>{{ $tintuc->nguon_tin }}</td>
               <td>{{ $tintuc->tom_tat }}</td>
               <td>{{ $tintuc->trang_thai }}</td>

                    <td>
                        @if( $tintuc->is_enabled )
                            <span class="badge bg-green">@lang('admin.pages.common.label.is_enabled_true')</span>
                        @else
                            <span class="badge bg-red">@lang('admin.pages.common.label.is_enabled_false')</span>
                        @endif
                    </td>
                    <td>
                        <a href="{!! action('Admin\TintucController@show', $tintuc->id) !!}" class="btn btn-block btn-primary btn-xs">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="btn btn-block btn-danger btn-xs delete-button" data-delete-url="{!! action('Admin\TintucController@destroy', $tintuc->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
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