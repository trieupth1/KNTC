<?php

namespace App\Presenters;

use Illuminate\Support\Facades\Redis;
use App\Models\Xa;

class ChuthePresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = [];

    /**
    * @return \App\Models\Xa
    * */
    public function xa()
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel('XaModel');
            $cached = Redis::hget($cacheKey, $this->entity->xa_id);

            if( $cached ) {
                $xa = new Xa(json_decode($cached, true));
                $xa['id'] = json_decode($cached, true)['id'];
                return $xa;
            } else {
                $xa = $this->entity->xa;
                Redis::hsetnx($cacheKey, $this->entity->xa_id, $xa);
                return $xa;
            }
        }

        $xa = $this->entity->xa;
        return $xa;
    }

    
}
