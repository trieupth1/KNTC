<?php namespace App\Models;



class Donvi extends Base
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'donvis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tendonvi',
        'tructhuoccap',
        'diachi',
        'phone',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\DonviPresenter::class;

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\DonviObserver);
    }

    // Relations
    

    // Utility Functions

    /*
     * API Presentation
     */
    public function toAPIArray()
    {
        return [
            'id' => $this->id,
            'tendonvi' => $this->tendonvi,
            'tructhuoccap' => $this->tructhuoccap,
            'diachi' => $this->diachi,
            'phone' => $this->phone,
        ];
    }

}
