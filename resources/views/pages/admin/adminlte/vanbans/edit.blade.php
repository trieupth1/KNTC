@extends('pages.admin.' . config('view.admin') . '.layout.application', ['menu' => 'vanbans'] )

@section('metadata')
    {{--<meta id="token" name="csrf_token" content="{{csrf_token()}}">--}}
@stop

@section('styles')
    <link rel="stylesheet"
          href="{!! \URLHelper::asset('libs/datetimepicker/css/bootstrap-datetimepicker.min.css', 'admin') !!}">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.5/css/froala_editor.pkgd.min.css'
          rel='stylesheet' type='text/css'/>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.5/css/froala_style.min.css' rel='stylesheet'
          type='text/css'/>

    <style>
        .autocomplete {
            /*the container must be positioned relative:*/
            position: relative;
            /*display: inline-block;*/
        }

        input-auto {
            border: 1px solid transparent;
            background-color: #f1f1f1;
            padding: 10px;
            font-size: 16px;
        }

        input-auto-text {
            background-color: #f1f1f1;
            width: 100%;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }

        .autocomplete-items div:hover {
            /*when hovering an item:*/
            background-color: #e9e9e9;
        }

        .autocomplete-active {
            /*when navigating through the items using the arrow keys:*/
            background-color: DodgerBlue !important;
            color: #ffffff;
        }
    </style>
@stop

@section('scripts')
    <script src="{{ \URLHelper::asset('libs/moment/moment.min.js', 'admin') }}"></script>
    <script src="{{ \URLHelper::asset('libs/datetimepicker/js/bootstrap-datetimepicker.min.js', 'admin') }}"></script>

    <script type='text/javascript'
            src='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.3.5/js/froala_editor.pkgd.min.js'></script>
    <script src="{{ \URLHelper::asset('js/pages/articles/edit.js', 'admin/adminlte') }}"></script>
    <script src="{{ \URLHelper::asset('js/pages/autocomplete_donvi/autocomplete_donvi.js', 'admin/adminlte') }}"></script>
    <script type="text/javascript">

        $('.datetime-field').datetimepicker({'format': 'DD/MM/YYYY HH:mm:ss', 'defaultDate': new Date()});

        var objEditVB = {
            numInput: 1,
            do_add_input: function () {
                if (objEditVB.numInput + 1 <= 5) {
                    objEditVB.numInput++;
                    var panel = $('#doi_tuong_lien_quan_' + objEditVB.numInput);
                    panel.show();
                }
            },
            do_remove_input: function () {
                if (objEditVB.numInput > 1) {
                    var panel = $('#doi_tuong_lien_quan_' + objEditVB.numInput);
                    panel.val(null);
                    panel.hide();

                    objEditVB.numInput--;
                }
            }
        };

        $(document).ready(function () {

            var url = '{!! URL::route('autocomplete') !!}';
            objAutoComplete.do_suggest('donvi_id', url);


        });


    </script>
@stop

@section('title')
@stop

@section('header')
    Vanbans
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\VanbanController@index') !!}"><i class="fa fa-files-o"></i> Vanbans</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $vanban->id }}</li>
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

    <form action="@if($isNew) {!! action('Admin\VanbanController@store') !!} @else {!! action('Admin\VanbanController@update', [$vanban->id]) !!} @endif"
          method="POST" enctype="multipart/form-data">
        @if( !$isNew ) <input type="hidden" name="_method" value="PUT"> @endif
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <a href="{!! URL::action('Admin\VanbanController@index') !!}"
                       class="btn btn-block btn-default btn-sm"
                       style="width: 125px;">@lang('admin.pages.common.buttons.back')</a>
                </h3>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('ten')) has-error @endif">
                            <label for="ten">@lang('admin.pages.vanbans.columns.ten') <span class="text-danger"> (*)</span></label>
                            <input type="text" class="form-control" id="ten" name="ten" required
                                   value="{{ old('ten') ? old('ten') : $vanban->ten }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('so_hieu')) has-error @endif">
                            <label for="so_hieu">@lang('admin.pages.vanbans.columns.so_hieu')</label>
                            <input type="text" class="form-control" id="so_hieu" name="so_hieu"
                                   value="{{ old('so_hieu') ? old('so_hieu') : $vanban->so_hieu }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('trich_dan')) has-error @endif">
                            <label for="trich_dan">@lang('admin.pages.vanbans.columns.trich_dan')</label>
                            <textarea id="froala-editor" name="trich_dan" class="form-control" rows="10"
                                      placeholder="@lang('admin.pages.vanbans.columns.trich_dan')">{{ old('trich_dan') ? old('trich_dan') : $vanban->trich_dan }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('donvi_id')) has-error @endif">
                            <label for="donvi_id">@lang('admin.pages.vanbans.columns.donvi_id')</label>

                            <div class="autocomplete">
                                <input type="text" class="form-control" id="donvi_id"
                                       value="{{ old('donvi_id') ? old('donvi_id') : $vanban->donvi_id }}">
                                <input type="hidden" id="hide_donvi_id" value="" name="donvi_id">
                                <div id="suggesstion-box" style="display: none"></div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('nguoi_ky')) has-error @endif">
                            <label for="nguoi_ky">@lang('admin.pages.vanbans.columns.nguoi_ky')</label>
                            <input type="text" class="form-control" id="nguoi_ky" name="nguoi_ky"
                                   value="{{ old('nguoi_ky') ? old('nguoi_ky') : $vanban->nguoi_ky }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ngay_ban_hanh">@lang('admin.pages.vanbans.columns.ngay_ban_hanh')</label>
                            <div class="input-group date datetime-field">
                               <?php
                                    $ngay_ban_hanh = $vanban->ngay_ban_hanh;
                                    if(!empty($vanban->ngay_ban_hanh)){
                                        $ngay_ban_hanh = date('d/m/Y H:i:s',strtotime($vanban->ngay_ban_hanh));
                                    }
                                ?>

                                <input type="text" class="form-control" name="ngay_ban_hanh" required
                                       value="{{ old('ngay_ban_hanh') ? date('d/m/Y H:i:s',strtotime(old('ngay_ban_hanh')))  : $ngay_ban_hanh }}">
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ngay_nhan">@lang('admin.pages.vanbans.columns.ngay_nhan')</label>
                            <div class="input-group date datetime-field">
                                <?php
                                $ngay_nhan = $vanban->ngay_nhan;
                                if(!empty($vanban->ngay_nhan)){
                                    $ngay_nhan = date('d/m/Y H:i:s',strtotime($vanban->ngay_nhan));
                                }
                                ?>
                                <input type="text" class="form-control" name="ngay_nhan" required
                                       value="{{ old('ngay_nhan') ? date('d/m/Y H:i:s',strtotime(old('ngay_nhan'))) :  $ngay_nhan }}">
                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('loai_van_ban')) has-error @endif">
                            <label for="loai_van_ban">@lang('admin.pages.vanbans.columns.loai_van_ban')</label>
                            <select class="form-control" id="loai_van_ban" name="loai_van_ban">
                                @foreach(\App\Models\Vanban::$aryLoaiVB as $key => $value)
                                    <option value="{{$key}}"> {{$value}}</option>
                                @endforeach
                            </select>


                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group @if ($errors->has('doi_tuong_lien_quan_1')) has-error @endif">
                            <label for="doi_tuong_lien_quan_1">@lang('admin.pages.vanbans.columns.doi_tuong_lien_quan_1')</label>
                            <input type="text" class="form-control" id="doi_tuong_lien_quan_1"
                                   name="doi_tuong_lien_quan_1"
                                   value="{{ old('doi_tuong_lien_quan_1') ? old('doi_tuong_lien_quan_1') : $vanban->doi_tuong_lien_quan_1 }}">
                            <input type="text" class="form-control" id="doi_tuong_lien_quan_2"
                                   name="doi_tuong_lien_quan_2" style="margin-top: 10px;display: none"
                                   value="{{ old('doi_tuong_lien_quan_2') ? old('doi_tuong_lien_quan_2') : $vanban->doi_tuong_lien_quan_2 }}">
                            <input type="text" class="form-control" id="doi_tuong_lien_quan_3"
                                   name="doi_tuong_lien_quan_3" style="margin-top: 10px;display: none"
                                   value="{{ old('doi_tuong_lien_quan_3') ? old('doi_tuong_lien_quan_3') : $vanban->doi_tuong_lien_quan_3 }}">
                            <input type="text" class="form-control" id="doi_tuong_lien_quan_4"
                                   name="doi_tuong_lien_quan_4" style="margin-top: 10px;display: none"
                                   value="{{ old('doi_tuong_lien_quan_4') ? old('doi_tuong_lien_quan_4') : $vanban->doi_tuong_lien_quan_4 }}">

                            <input type="text" class="form-control" id="doi_tuong_lien_quan_5"
                                   name="doi_tuong_lien_quan_5" style="margin-top: 10px;display: none"
                                   value="{{ old('doi_tuong_lien_quan_5') ? old('doi_tuong_lien_quan_5') : $vanban->doi_tuong_lien_quan_5 }}">

                        </div>
                    </div>

                    <div class="col-md-2 " style="padding-top: 10px">
                        <br/>
                        <span id="addfile" class="btn btn-xs btn-success glyphicon glyphicon-plus"
                              style="cursor: pointer" onclick="objEditVB.do_add_input();"></span>
                        <span id="remove" class="btn btn-xs btn-danger glyphicon glyphicon-minus"
                              onclick="objEditVB.do_remove_input();" style="cursor: pointer"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('don_id')) has-error @endif">
                            <label for="nguoi_ky">@lang('admin.pages.vanbans.columns.don_id')</label>
                            <input type="text" class="form-control" id="don_id" name="don_id"
                                   value="{{ old('don_id') ? old('don_id') : $vanban->don_id }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group ">
                            <label for="file_vb"></label>
                            <input type="file" class="form-control" id="file_vb" name="file_vb">
                        </div>
                    </div>
                </div>


            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm"
                        style="width: 125px;">@lang('admin.pages.common.buttons.save')</button>
            </div>
        </div>
    </form>
@stop
