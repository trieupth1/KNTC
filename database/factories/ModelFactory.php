<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(
    App\Models\User::class,
    function (Faker\Generator $faker) {
        return [
            'name'                 => $faker->name,
            'email'                => $faker->email,
            'password'             => bcrypt(str_random(10)),
            'remember_token'       => str_random(10),
            'gender'               => 1,
            'telephone'            => $faker->phoneNumber,
            'birthday'             => $faker->date('Y-m-d'),
            'locale'               => $faker->languageCode,
            'address'              => $faker->address,
            'last_notification_id' => 0,
            'api_access_token'     => '',
            'profile_image_id'     => 0,
            'is_activated'         => 0,
        ];
    }
);

$factory->define(
    App\Models\AdminUser::class,
    function (Faker\Generator $faker) {
        return [
            'name'                 => $faker->name,
            'email'                => $faker->email,
            'password'             => bcrypt(str_random(10)),
            'remember_token'       => str_random(10),
            'locale'               => $faker->languageCode,
            'last_notification_id' => 0,
            'api_access_token'     => '',
            'profile_image_id'     => 0,
        ];
    }
);

$factory->define(
    App\Models\AdminUserRole::class,
    function (Faker\Generator $faker) {
        return [
            'admin_user_id' => $faker->randomNumber(),
            'role'          => 'supper_user'
        ];
    }
);

$factory->define(
    App\Models\SiteConfiguration::class,
    function (Faker\Generator $faker) {
        return [
            'locale'                => 'ja',
            'name'                  => $faker->name,
            'title'                 => $faker->sentence,
            'keywords'              => implode(',', $faker->words(5)),
            'description'           => $faker->sentences(3, true),
            'ogp_image_id'          => 0,
            'twitter_card_image_id' => 0,
        ];
    }
);

$factory->define(
    App\Models\Image::class,
    function (Faker\Generator $faker) {
        return [
            'url'                => $faker->imageUrl(),
            'title'              => $faker->sentence,
            'is_local'           => false,
            'entity_type'        => $faker->word,
            'entity_id'          => 0,
            'file_category_type' => $faker->word,
            's3_key'             => $faker->word,
            's3_bucket'          => $faker->word,
            's3_region'          => $faker->word,
            's3_extension'       => 'png',
            'media_type'         => 'image/png',
            'format'             => 'png',
            'file_size'          => 0,
            'width'              => 100,
            'height'             => 100,
            'is_enabled'         => true,
        ];
    }
);

$factory->define(
    App\Models\Article::class,
    function (Faker\Generator $faker) {
        return [
            'slug'               => $faker->word,
            'title'              => $faker->sentence,
            'keywords'           => implode(',', $faker->words(5)),
            'description'        => $faker->sentences(3, true),
            'content'            => $faker->sentences(3, true),
            'cover_image_id'     => 0,
            'locale'             => 'ja',
            'is_enabled'         => true,
            'publish_started_at' => $faker->dateTime,
            'publish_ended_at'   => null,
        ];
    }
);

$factory->define(
    App\Models\UserNotification::class,
    function (Faker\Generator $faker) {
        return [
            'user_id'       => \App\Models\UserNotification::BROADCAST_USER_ID,
            'category_type' => \App\Models\UserNotification::CATEGORY_TYPE_SYSTEM_MESSAGE,
            'type'          => \App\Models\UserNotification::TYPE_GENERAL_MESSAGE,
            'data'          => '',
            'locale'        => 'en',
            'content'       => 'TEST',
            'read'          => false,
            'sent_at'       => $faker->dateTime,
        ];
    }
);

$factory->define(
    App\Models\AdminUserNotification::class,
    function (Faker\Generator $faker) {
        return [
            'user_id'       => \App\Models\AdminUserNotification::BROADCAST_USER_ID,
            'category_type' => \App\Models\AdminUserNotification::CATEGORY_TYPE_SYSTEM_MESSAGE,
            'type'          => \App\Models\AdminUserNotification::TYPE_GENERAL_MESSAGE,
            'data'          => '',
            'locale'        => 'en',
            'content'       => 'TEST',
            'read'          => false,
            'sent_at'       => $faker->dateTime,
        ];
    }
);

$factory->define(App\Models\Don::class, function (Faker\Generator $faker) {
    return [
        'id' => '',
        'tieude' => '',
        'sohieu' => '',
        'ngayvietdon' => '',
        'noidung' => '',
        'loaidon_id' => '',
        'admin_user_id' => '',
        'nhomdon_id' => '',
        'hanxuly' => '',
        'don_quoc_gia_id' => '',
        'nguondon_id' => '',
        'nguondon_type' => '',
    ];
});

$factory->define(App\Models\VanBan::class, function (Faker\Generator $faker) {
    return [
    ];
});

$factory->define(App\Models\Vanban::class, function (Faker\Generator $faker) {
    return [
        'id' => '',
        'ten' => '',
        'so_hieu' => '',
        'trich_dan' => '',
        'ngay_ban_hanh' => '',
        'ngay_nhan' => '',
        'loai_van_ban' => '',
        'don_id' => '',
        'admin_user_id' => '',
        'nguoi_ky' => '',
        'donvi_id' => '',
        'doi_tuong_lien_quan_1' => '',
        'doi_tuong_lien_quan_2' => '',
        'doi_tuong_lien_quan_3' => '',
        'doi_tuong_lien_quan_4' => '',
        'doi_tuong_lien_quan_5' => '',
    ];
});

$factory->define(App\Models\Vanban::class, function (Faker\Generator $faker) {
    return [
        'id' => '',
        'ten' => '',
        'so_hieu' => '',
        'trich_dan' => '',
        'ngay_ban_hanh' => '',
        'ngay_nhan' => '',
        'loai_van_ban' => '',
        'don_id' => '',
        'admin_user_id' => '',
        'nguoi_ky' => '',
        'donvi_id' => '',
    ];
});

$factory->define(App\Models\Donvi::class, function (Faker\Generator $faker) {
    return [
        'id' => '',
        'tendonvi' => '',
        'tructhuoccap' => '',
        'diachi' => '',
        'phone' => '',
    ];
});

$factory->define(App\Models\Tintuc::class, function (Faker\Generator $faker) {
    return [
        'id' => '',
        'tieu_de' => '',
        'ngay_dang' => '',
        'the_loai' => '',
        'nguon_tin' => '',
        'image_id' => '',
        'tom_tat' => '',
        'noi_dung' => '',
        'trang_thai' => '',
    ];
});

$factory->define(App\Models\Don::class, function (Faker\Generator $faker) {
    return [
        'id' => '',
        'tieude' => '',
        'sohieu' => '',
        'ngayvietdon' => '',
        'noidung' => '',
        'loaidon_id' => '',
        'admin_user_id' => '',
        'don_quoc_gia_id' => '',
        'nguondon_id' => '',
        'nguondon_type' => '',
        'socongvan' => '',
        'vanbanuyquen' => '',
        'doituongtrendon' => '',
        'nguoilienquan' => '',
        'hanxuly' => '',
        'tailieudinhkem' => '',
        'trangthai' => '',
    ];
});

$factory->define(App\Models\Chuthe::class, function (Faker\Generator $faker) {
    return [
        'id' => '',
        'ten' => '',
        'email' => '',
        'socmt' => '',
        'noicapcmt' => '',
        'ngaycapcmt' => '',
        'gioi_tinh' => '',
        'phone' => '',
        'ngay_sinh' => '',
        'dia_chi' => '',
        'loai_chu_the' => '',
        'xa_id' => '',
        'hinhanh' => '',
        'languoidaidien' => '',
    ];
});

$factory->define(App\Models\Donviguidon::class, function (Faker\Generator $faker) {
    return [
        'id' => '',
        'sokyhieu' => '',
        'donvi_id' => '',
        'ngaybanhanh' => '',
    ];
});

$factory->define(App\Models\Don::class, function (Faker\Generator $faker) {
    return [
        'id' => '',
        'tieude' => '',
        'sohieu' => '',
        'ngayvietdon' => '',
        'noidung' => '',
        'loaidon_id' => '',
        'admin_user_id' => '',
        'don_quoc_gia_id' => '',
        'nguondon_id' => '',
        'nguondon_type' => '',
        'socongvan' => '',
        'vanbanuyquen' => '',
        'doituongtrendon' => '',
        'nguoilienquan' => '',
        'hanxuly' => '',
        'tailieudinhkem' => '',
        'trangthai' => '',
    ];
});

$factory->define(App\Models\Don::class, function (Faker\Generator $faker) {
    return [
        'id' => '',
        'tieude' => '',
        'sohieu' => '',
        'ngayvietdon' => '',
        'noidung' => '',
        'loaidon_id' => '',
        'admin_user_id' => '',
        'don_quoc_gia_id' => '',
        'nguondon_id' => '',
        'nguondon_type' => '',
        'socongvan' => '',
        'vanbanuyquen' => '',
        'doituongtrendon' => '',
        'nguoilienquan' => '',
        'hanxuly' => '',
        'tailieudinhkem' => '',
        'trangthai' => '',
    ];
});

$factory->define(App\Models\Don::class, function (Faker\Generator $faker) {
    return [
        'id' => '',
        'tieude' => '',
        'sohieu' => '',
        'ngayvietdon' => '',
        'ngaynhan' => '',
        'noidung' => '',
        'loaidon_id' => '',
        'admin_user_id' => '',
        'don_quoc_gia_id' => '',
        'nguondon_id' => '',
        'nguondon_type' => '',
        'socongvan' => '',
        'vanbanuyquen' => '',
        'doituongtrendon' => '',
        'nguoilienquan' => '',
        'hanxuly' => '',
        'tailieudinhkem' => '',
        'trangthai' => '',
    ];
});

/* NEW MODEL FACTORY */
