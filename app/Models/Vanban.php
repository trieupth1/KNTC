<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Vanban extends Base
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vanbans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ten',
        'so_hieu',
        'trich_dan',
        'ngay_ban_hanh',
        'ngay_nhan',
        'loai_van_ban',
        'don_id',
        'admin_user_id',
        'nguoi_ky',
        'donvi_id',
        'doi_tuong_lien_quan_1',
        'doi_tuong_lien_quan_2',
        'doi_tuong_lien_quan_3',
        'doi_tuong_lien_quan_4',
        'doi_tuong_lien_quan_5',
    ];

    const VB_DEN = 1;
    const VB_PHAT_HANH = 2;
    const VB_PHAP_LUAT = 3;

    public static $aryLoaiVB = [
        self::VB_DEN => 'Văn bản đến',
        self::VB_PHAT_HANH => 'Văn bản phát hành',
        self::VB_PHAP_LUAT => 'Văn bản pháp luật'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates = ['ngay_ban_hanh', 'ngay_nhan', 'deleted_at'];

    protected $presenter = \App\Presenters\VanbanPresenter::class;

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\VanbanObserver);
    }

    // Relations
    public function don()
    {
        return $this->belongsTo(\App\Models\Don::class, 'don_id', 'id');
    }

    public function adminUser()
    {
        return $this->belongsTo(\App\Models\AdminUser::class, 'admin_user_id', 'id');
    }

    public function donvi()
    {
        return $this->belongsTo(\App\Models\Donvi::class, 'donvi_id', 'id');
    }



    // Utility Functions

    /*
     * API Presentation
     */
    public function toAPIArray()
    {
        return [
            'id' => $this->id,
            'ten' => $this->ten,
            'so_hieu' => $this->so_hieu,
            'trich_dan' => $this->trich_dan,
            'ngay_ban_hanh' => $this->ngay_ban_hanh,
            'ngay_nhan' => $this->ngay_nhan,
            'loai_van_ban' => $this->loai_van_ban,
            'don_id' => $this->don_id,
            'admin_user_id' => $this->admin_user_id,
            'nguoi_ky' => $this->nguoi_ky,
            'donvi_id' => $this->donvi_id,
            'doi_tuong_lien_quan_1' => $this->doi_tuong_lien_quan_1,
            'doi_tuong_lien_quan_2' => $this->doi_tuong_lien_quan_2,
            'doi_tuong_lien_quan_3' => $this->doi_tuong_lien_quan_3,
            'doi_tuong_lien_quan_4' => $this->doi_tuong_lien_quan_4,
            'doi_tuong_lien_quan_5' => $this->doi_tuong_lien_quan_5,
        ];
    }

}
