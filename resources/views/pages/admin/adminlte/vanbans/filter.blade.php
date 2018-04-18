<div class="form-group col-sm-3">
    <label for="">Số hiệu:</label><br/>
    <input type="text" name="filter[shVB]" id="txt_shVB" class="form-control"
           value=" ">

</div>

<div class="form-group col-sm-3">
    <label for="">Tên :</label><br/>
    <input type="text" name="filter[nameVB]" id="txt_nameVB" class="form-control"
           value=" ">

</div>

<div class="form-group col-sm-3">
    <label for="">Loại Văn Bản:</label><br/>
    <select class="form-control" id="select_loaiVB" name="filter[loaiVB]">
        <option value="-1"></option>
        @foreach(\App\Models\Vanban::$aryLoaiVB as $key=>$value)
            <option value="{{$key}}">{{$value}}</option>
        @endforeach
    </select>


</div>

<div class="form-group col-sm-3">
    <label for="">Người Ký:</label><br/>
    <input type="text" name="filter[nkVB]" id="txt_nkVB" class="form-control"
           value=" ">

</div>

<div class="form-group col-sm-3">
    <label for="">Ngày ban hành:</label>
    <br/>
    <div class="input-group date datetime-field">
        <span class="input-group-addon" >Từ</span>
        <input type="text" name="filter[bhTo]" id="txt_bhTo" class="form-control"
               value=" ">
    </div>
    <br/>
    <div class="input-group date datetime-field">
        <span class="input-group-addon" >Đến</span>
        <input type="text" name="filter[bhDen]" id="txt_bhDen" class="form-control"
               value=" ">
    </div>

</div>

<div class="form-group col-sm-3">
    <label for="">Ngày nhận:</label>
    <br/>
    <div class="input-group date datetime-field">
        <span class="input-group-addon" >Từ</span>
        <input type="text" name="filter[nnTo]" id="txt_nnTo" class="form-control"
               value=" ">
    </div>
    <br/>
    <div class="input-group date datetime-field">
        <span class="input-group-addon" >Đến</span>
        <input type="text" name="filter[nnDen]" id="txt_nnDen" class="form-control"
               value=" ">
    </div>

</div>