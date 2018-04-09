@extends('pages.admin.' . config('view.admin') . '.layout.application', ['menu' => 'dons'] )

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
Dons
@stop

@section('breadcrumb')
<li class="active">Dons</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="box-title">
                    <p class="text-right">
                        <a href="{!! action('Admin\DonController@create') !!}" class="btn btn-block btn-primary btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.create')</a>
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
                <th>{!! \PaginationHelper::sort('tieude', trans('admin.pages.dons.columns.tieude')) !!}</th>
                <th>{!! \PaginationHelper::sort('sohieu', trans('admin.pages.dons.columns.sohieu')) !!}</th>
                <th>{!! \PaginationHelper::sort('ngayvietdon', trans('admin.pages.dons.columns.ngayvietdon')) !!}</th>
                <th>{!! \PaginationHelper::sort('hanxuly', trans('admin.pages.dons.columns.hanxuly')) !!}</th>
                <th>{!! \PaginationHelper::sort('nguondon_type', trans('admin.pages.dons.columns.nguondon_type')) !!}</th>

                <th style="width: 40px">{!! \PaginationHelper::sort('is_enabled', trans('admin.pages.common.label.is_enabled')) !!}</th>
                <th style="width: 40px">@lang('admin.pages.common.label.actions')</th>
            </tr>
            @foreach( $dons as $don )
                <tr>
                    <td>{{ $don->id }}</td>
               <td>{{ $don->tieude }}</td>
               <td>{{ $don->sohieu }}</td>
               <td>{{ $don->ngayvietdon }}</td>
               <td>{{ $don->hanxuly }}</td>
               <td>{{ $don->nguondon_type }}</td>

                    <td>
                        @if( $don->is_enabled )
                            <span class="badge bg-green">@lang('admin.pages.common.label.is_enabled_true')</span>
                        @else
                            <span class="badge bg-red">@lang('admin.pages.common.label.is_enabled_false')</span>
                        @endif
                    </td>
                    <td>
                        <a href="{!! action('Admin\DonController@show', $don->id) !!}" class="btn btn-block btn-primary btn-xs">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="btn btn-block btn-danger btn-xs delete-button" data-delete-url="{!! action('Admin\DonController@destroy', $don->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
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