<?php namespace App\Models;



class Donviguidon extends Base
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'donviguidons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sokyhieu',
        'donvi_id',
        'ngaybanhanh',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\DonviguidonPresenter::class;

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\DonviguidonObserver);
    }

    // Relations
    public function donvi()
    {
        return $this->belongsTo(\App\Models\Donvi::class, 'donvi_id', 'id');
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
            'sokyhieu' => $this->sokyhieu,
            'donvi_id' => $this->donvi_id,
            'ngaybanhanh' => $this->ngaybanhanh,
        ];
    }

}
