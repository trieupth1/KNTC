<?php

namespace App\Presenters;

use Illuminate\Support\Facades\Redis;
use App\Models\Donvi;

class DonviguidonPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = [];

    /**
    * @return \App\Models\Donvi
    * */
    public function donvi()
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel('DonviModel');
            $cached = Redis::hget($cacheKey, $this->entity->donvi_id);

            if( $cached ) {
                $donvi = new Donvi(json_decode($cached, true));
                $donvi['id'] = json_decode($cached, true)['id'];
                return $donvi;
            } else {
                $donvi = $this->entity->donvi;
                Redis::hsetnx($cacheKey, $this->entity->donvi_id, $donvi);
                return $donvi;
            }
        }

        $donvi = $this->entity->donvi;
        return $donvi;
    }

    
}
