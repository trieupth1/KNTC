<?php

namespace App\Presenters;

use Illuminate\Support\Facades\Redis;
use App\Models\Don;
use App\Models\AdminUser;
use App\Models\Donvi;

class VanbanPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = [];

    /**
    * @return \App\Models\Don
    * */
    public function don()
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel('DonModel');
            $cached = Redis::hget($cacheKey, $this->entity->don_id);

            if( $cached ) {
                $don = new Don(json_decode($cached, true));
                $don['id'] = json_decode($cached, true)['id'];
                return $don;
            } else {
                $don = $this->entity->don;
                Redis::hsetnx($cacheKey, $this->entity->don_id, $don);
                return $don;
            }
        }

        $don = $this->entity->don;
        return $don;
    }

    /**
    * @return \App\Models\AdminUser
    * */
    public function adminUser()
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel('AdminUserModel');
            $cached = Redis::hget($cacheKey, $this->entity->admin_user_id);

            if( $cached ) {
                $adminUser = new AdminUser(json_decode($cached, true));
                $adminUser['id'] = json_decode($cached, true)['id'];
                return $adminUser;
            } else {
                $adminUser = $this->entity->adminUser;
                Redis::hsetnx($cacheKey, $this->entity->admin_user_id, $adminUser);
                return $adminUser;
            }
        }

        $adminUser = $this->entity->adminUser;
        return $adminUser;
    }

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
