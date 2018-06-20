<?php

namespace App\Presenters;

use Illuminate\Support\Facades\Redis;
use App\Models\Loaidon;
use App\Models\AdminUser;
use App\Models\DonQuocGia;
use App\Models\Nguondon;

class DonPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = [];

    /**
    * @return \App\Models\Loaidon
    * */
    public function loaidon()
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel('LoaidonModel');
            $cached = Redis::hget($cacheKey, $this->entity->loaidon_id);

            if( $cached ) {
                $loaidon = new Loaidon(json_decode($cached, true));
                $loaidon['id'] = json_decode($cached, true)['id'];
                return $loaidon;
            } else {
                $loaidon = $this->entity->loaidon;
                Redis::hsetnx($cacheKey, $this->entity->loaidon_id, $loaidon);
                return $loaidon;
            }
        }

        $loaidon = $this->entity->loaidon;
        return $loaidon;
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
    * @return \App\Models\DonQuocGia
    * */
    public function donQuocGia()
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel('DonQuocGiaModel');
            $cached = Redis::hget($cacheKey, $this->entity->don_quoc_gia_id);

            if( $cached ) {
                $donQuocGia = new DonQuocGia(json_decode($cached, true));
                $donQuocGia['id'] = json_decode($cached, true)['id'];
                return $donQuocGia;
            } else {
                $donQuocGia = $this->entity->donQuocGia;
                Redis::hsetnx($cacheKey, $this->entity->don_quoc_gia_id, $donQuocGia);
                return $donQuocGia;
            }
        }

        $donQuocGia = $this->entity->donQuocGia;
        return $donQuocGia;
    }

    /**
    * @return \App\Models\Nguondon
    * */
    public function nguondon()
    {
        if( \CacheHelper::cacheRedisEnabled() ) {
            $cacheKey = \CacheHelper::keyForModel('NguondonModel');
            $cached = Redis::hget($cacheKey, $this->entity->nguondon_id);

            if( $cached ) {
                $nguondon = new Nguondon(json_decode($cached, true));
                $nguondon['id'] = json_decode($cached, true)['id'];
                return $nguondon;
            } else {
                $nguondon = $this->entity->nguondon;
                Redis::hsetnx($cacheKey, $this->entity->nguondon_id, $nguondon);
                return $nguondon;
            }
        }

        $nguondon = $this->entity->nguondon;
        return $nguondon;
    }

    
}
