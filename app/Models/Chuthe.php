<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Chuthe extends Base
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'chuthes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ten',
        'email',
        'socmt',
        'noicapcmt',
        'ngaycapcmt',
        'gioi_tinh',
        'phone',
        'ngay_sinh',
        'dia_chi',
        'loai_chu_the',
        'xa_id',
        'hinhanh',
        'languoidaidien',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = ['deleted_at'];

    protected $presenter = \App\Presenters\ChuthePresenter::class;

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\ChutheObserver);
    }

    // Relations
    public function xa()
    {
        return $this->belongsTo(\App\Models\Xa::class, 'xa_id', 'id');
    }

    public function don()
    {
        return $this->morphMany(\App\Models\Don::class, 'Dontable');
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
            'email' => $this->email,
            'socmt' => $this->socmt,
            'noicapcmt' => $this->noicapcmt,
            'ngaycapcmt' => $this->ngaycapcmt,
            'gioi_tinh' => $this->gioi_tinh,
            'phone' => $this->phone,
            'ngay_sinh' => $this->ngay_sinh,
            'dia_chi' => $this->dia_chi,
            'loai_chu_the' => $this->loai_chu_the,
            'xa_id' => $this->xa_id,
            'hinhanh' => $this->hinhanh,
            'languoidaidien' => $this->languoidaidien,
        ];
    }

}
