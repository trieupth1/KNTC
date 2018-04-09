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
        'noidung',
        'loaidon_id',
        'admin_user_id',
        'nhomdon_id',
        'hanxuly',
        'don_quoc_gia_id',
        'nguondon_id',
        'nguondon_type',
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

    public function nhomdon()
    {
        return $this->belongsTo(\App\Models\Nhomdon::class, 'nhomdon_id', 'id');
    }

    public function donQuocGia()
    {
        return $this->belongsTo(\App\Models\DonQuocGia::class, 'don_quoc_gia_id', 'id');
    }

    public function nguondon()
    {
        return $this->belongsTo(\App\Models\Nguondon::class, 'nguondon_id', 'id');
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
            'noidung' => $this->noidung,
            'loaidon_id' => $this->loaidon_id,
            'admin_user_id' => $this->admin_user_id,
            'nhomdon_id' => $this->nhomdon_id,
            'hanxuly' => $this->hanxuly,
            'don_quoc_gia_id' => $this->don_quoc_gia_id,
            'nguondon_id' => $this->nguondon_id,
            'nguondon_type' => $this->nguondon_type,
        ];
    }

}
