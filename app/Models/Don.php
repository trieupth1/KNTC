<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Don extends Base
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tieude',
        'sohieu',
        'ngayvietdon',
        'ngaynhan',
        'noidung',
        'loaidon_id',
        'admin_user_id',
        'don_quoc_gia_id',
        'nguondon_id',
        'nguondon_type',
        'socongvan',
        'ngaybanhanh',
        'vanbanuyquen',
        'doituongtrendon',
        'nguoilienquan',
        'hanxuly',
        'tailieudinhkem',
        'trangthai',
    ];
    const CHO_XY_LY = 1;
    const DANG_XY_LY = 2;
    const DA_XY_LY = 3;

    public $aryDonStatus = [
        self::CHO_XY_LY => 'Chờ xử lý',
        self::DANG_XY_LY => 'Đang xử lý',
        self::DA_XY_LY => 'Đã xử lý'
    ];


    const CA_NHAN_GUI_DEN = 1;
    const TAP_THE_GUI_DEN = 2;
    const DON_VI_GUI_DEN = 3;

    public static $aryNguonDon = [
        self::CA_NHAN_GUI_DEN => 'Do dân gửi đến (cá nhân)',
        self::TAP_THE_GUI_DEN => 'Do dân gửi đến (tập thể)',
        self::DON_VI_GUI_DEN => 'Do đơn vi khác gửi đến'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = ['deleted_at'];

    protected $presenter = \App\Presenters\DonPresenter::class;

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\DonObserver);
    }

    // Relations
    public function loaidon()
    {
        return $this->belongsTo(\App\Models\Loaidon::class, 'loaidon_id', 'id');
    }

    public function adminUser()
    {
        return $this->belongsTo(\App\Models\AdminUser::class, 'admin_user_id', 'id');
    }

    public function donQuocGia()
    {
        return $this->belongsTo(\App\Models\DonQuocGia::class, 'don_quoc_gia_id', 'id');
    }

    public function nguondon()
    {
        return $this->belongsTo(\App\Models\Nguondon::class, 'nguondon_id', 'id');
    }

    public function Dontable()
    {
        return $this->morphTo();
    }


    // Utility Functions

    /*
     * API Presentation
     */
    public function toAPIArray()
    {
        return [
            'id' => $this->id,
            'tieude' => $this->tieude,
            'sohieu' => $this->sohieu,
            'ngayvietdon' => $this->ngayvietdon,
            'ngaynhan' => $this->ngaynhan,
            'noidung' => $this->noidung,
            'loaidon_id' => $this->loaidon_id,
            'admin_user_id' => $this->admin_user_id,
            'don_quoc_gia_id' => $this->don_quoc_gia_id,
            'nguondon_id' => $this->nguondon_id,
            'nguondon_type' => $this->nguondon_type,
            'socongvan' => $this->socongvan,
            'ngaybanhanh' => $this->ngaybanhanh,
            'vanbanuyquen' => $this->vanbanuyquen,
            'doituongtrendon' => $this->doituongtrendon,
            'nguoilienquan' => $this->nguoilienquan,
            'hanxuly' => $this->hanxuly,
            'tailieudinhkem' => $this->tailieudinhkem,
            'trangthai' => $this->trangthai,
        ];
    }

}
