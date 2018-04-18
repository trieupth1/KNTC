<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Tintuc extends Base
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tintucs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tieu_de',
        'ngay_dang',
        'the_loai',
        'nguon_tin',
        'image_id',
        'tom_tat',
        'noi_dung',
        'trang_thai',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = ['ngay_dang','deleted_at'];

    protected $presenter = \App\Presenters\TintucPresenter::class;

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\TintucObserver);
    }

    // Relations
    public function image()
    {
        return $this->belongsTo(\App\Models\Image::class, 'image_id', 'id');
    }

    

    // Utility Functions

    /*
     * API Presentation
     */
    public function toAPIArray()
    {
        return [
            'id' => $this->id,
            'tieu_de' => $this->tieu_de,
            'ngay_dang' => $this->ngay_dang,
            'the_loai' => $this->the_loai,
            'nguon_tin' => $this->nguon_tin,
            'image_id' => $this->image_id,
            'tom_tat' => $this->tom_tat,
            'noi_dung' => $this->noi_dung,
            'trang_thai' => $this->trang_thai,
        ];
    }

}
