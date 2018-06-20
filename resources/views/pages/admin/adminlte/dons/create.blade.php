@extends('pages.admin.' . config('view.admin') . '.layout.application', ['menu' => 'dons'] )

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
        $('.date-field').datetimepicker({'format': 'DD-MM-YYYY', 'defaultDate': new Date()});

        $(document).ready(function () {
            
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#nguonDonTypeId").change(function () {
                var nguonDonType = $(this).val();
                if(nguonDonType == 1)
                {
                    $("#danchuyenden").show();
                    $("#canhan").show();
                    $("#tapthe").hide();
                    $("#donvichuyenden").hide();
                }
                else if (nguonDonType == 2)
                {
                    $("#danchuyenden").show();
                    $("#canhan").hide();
                    $("#tapthe").show();
                    $("#donvichuyenden").hide();
                }
                else if (nguonDonType == 3)
                {
                    $("#danchuyenden").hide();
                    $("#donvichuyenden").show();
                }
                else
                {
                    $("#danchuyenden").hide();
                    $("#donvichuyenden").hide();
                }

            })
        })

    </script>
@stop

@section('title')
@stop

@section('header')
    Dons
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\DonController@index') !!}"><i class="fa fa-files-o"></i> Dons</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $don->id }}</li>
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

    <form action="@if($isNew) {!! action('Admin\DonController@store') !!} @else {!! action('Admin\DonController@update', [$don->id]) !!} @endif" method="POST" enctype="multipart/form-data">
        @if( !$isNew ) <input type="hidden" name="_method" value="PUT"> @endif
        {!! csrf_field() !!}

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <a href="{!! URL::action('Admin\DonController@index') !!}" class="btn btn-block btn-default btn-sm" style="width: 125px;">@lang('admin.pages.common.buttons.back')</a>
                </h3>
            </div>
            <div class="box-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('tieude')) has-error @endif">
                                <label for="tieude">@lang('admin.pages.dons.columns.tieude')</label>
                                <input type="text" class="form-control" id="tieude" name="tieude" required value="{{ old('tieude') ? old('tieude') : $don->tieude }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group @if ($errors->has('sohieu')) has-error @endif">
                                <label for="sohieu">@lang('admin.pages.dons.columns.sohieu')</label>
                                <input type="text" class="form-control" id="sohieu" name="sohieu" required value="{{ old('sohieu') ? old('sohieu') : $don->sohieu }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group @if ($errors->has('ngayvietdon')) has-error @endif">
                                <label for="ngayvietdon">@lang('admin.pages.dons.columns.ngayvietdon')</label>
                                <div class="input-group date date-field">
                                    <input type="text" class="form-control" id="ngayvietdon" name="ngayvietdon" required
                                           value="{{ old('ngayvietdon') ? old('ngayvietdon') : $don->ngayvietdon }}">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">

                                        </span>
                                    </span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group @if ($errors->has('ngaynhan')) has-error @endif">
                                <label for="ngaynhan">@lang('admin.pages.dons.columns.ngaynhan')</label>
                                <div class="input-group date date-field">
                                    <input type="text" class="form-control" id="ngaynhan" name="ngaynhan" required
                                           value="{{ old('ngaynhan') ? old('ngaynhan') : $don->ngayvietdon }}">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">

                                        </span>
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @if ($errors->has('nguondon_type')) has-error @endif">
                                <label for="nguondon_type">@lang('admin.pages.dons.columns.nguondon_type')</label>
                                <select class="form-control" name="NguonDonType" id="nguonDonTypeId">
                                    <option value="0"></option>
                                    @foreach(\App\Models\Don::$aryNguonDon as $key=>$value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> Loại đơn</label>
                                <select class="form-control" name="LoaiDon">
                                    <option>--load từ bảng loại đơn--</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id = "danchuyenden" style="display:none">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label> Tên chủ thể</label>
                                    <input type="text" class="form-control"  name="ten">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label> Số điện thoại</label>
                                    <input type="text" class="form-control"  name="phone">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label> Địa chỉ (Thôn/Xóm)</label>
                                    <input type="text" class="form-control"  name="dia_chi">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label> Xã </label>
                                    <input type="text" class="form-control"  name="xa">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label> Số CMND/ Hộ Chiếu</label>
                                    <input type="text" class="form-control"  name="socmt">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ngày cấp</label>
                                    <div class="input-group date date-field">
                                        <input type="text" class="form-control"  name="ngaycapcmt" >
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">
                                        </span>
                                    </span>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> Nơi cấp</label>
                                    <input type="text" class="form-control"  name="noicapcmt">
                                </div>
                            </div>
                        </div>
                        <div id = "tapthe">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group @if ($errors->has('vanbanuyquen')) has-error @endif">
                                        <label for="vanbanuyquen">@lang('admin.pages.dons.columns.vanbanuyquen')</label>
                                        <input type="text" class="form-control" id="vanbanuyquen" name="vanbanuyquen" required value="{{ old('vanbanuyquen') ? old('vanbanuyquen') : $don->vanbanuyquen }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Là người đại diện </label>
                                        <div class="switch">
                                            <input id="is_enabled" name="languoidaidien" value="0"
                                                   {{--@if( $don->is_enabled) checked @endif--}}
                                                   class="cmn-toggle cmn-toggle-round-flat" type="checkbox">
                                            <label for="is_enabled"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id = "canhan">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label >Ảnh người viết đơn </label>
                                        <input type="file" name = "hinhanh" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id = "donvichuyenden" style="display:none">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label> Tên đơn vị</label>
                                    <input type="text" class="form-control"  name="tendonvi">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label> Địa chỉ</label>
                                    <input type="text" class="form-control"  name="diachi">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group @if ($errors->has('socongvan')) has-error @endif">
                                    <label for="socongvan">@lang('admin.pages.dons.columns.socongvan')</label>
                                    <input type="text" class="form-control" id="socongvan" name="socongvan" required value="{{ old('socongvan') ? old('socongvan') : $don->socongvan }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ngày ban hành</label>
                                    <div class="input-group date date-field">
                                        <input type="text" class="form-control"  name="ngaybanhanh" >
                                        <span class="input-group-addon">
                                             <span class="glyphicon glyphicon-calendar">
                                            </span>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('noidung')) has-error @endif">
                                <label for="noidung">@lang('admin.pages.dons.columns.noidung')</label>
                                <textarea name="noidung" class="form-control" rows="5" required placeholder="@lang('admin.pages.dons.columns.noidung')">{{ old('noidung') ? old('noidung') : $don->noidung }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @if ($errors->has('doituongtrendon')) has-error @endif">
                                <label for="doituongtrendon">@lang('admin.pages.dons.columns.doituongtrendon')</label>
                                <input type="text" class="form-control" id="doituongtrendon" name="doituongtrendon" required value="{{ old('doituongtrendon') ? old('doituongtrendon') : $don->doituongtrendon }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @if ($errors->has('nguoilienquan')) has-error @endif">
                                <label for="nguoilienquan">@lang('admin.pages.dons.columns.nguoilienquan')</label>
                                <input type="text" class="form-control" id="nguoilienquan" name="nguoilienquan" required value="{{ old('nguoilienquan') ? old('nguoilienquan') : $don->nguoilienquan }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group @if ($errors->has('hanxuly')) has-error @endif">
                                <label for="hanxuly">@lang('admin.pages.dons.columns.hanxuly')</label>
                                <div class="input-group date date-field">
                                    <input type="text" class="form-control"  name="hanxuly" >
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group @if ($errors->has('tailieudinhkem')) has-error @endif">
                                <label for="tailieudinhkem">@lang('admin.pages.dons.columns.tailieudinhkem')</label>
                                <input type="file" name = "tailieudinhkem" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group @if ($errors->has('trangthai')) has-error @endif">
                                <label for="trangthai">@lang('admin.pages.dons.columns.trangthai')</label>
                                <select class="form-control" name="LoaiDon">
                                    <option>--load từ bảng trạng thái--</option>
                                </select>
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