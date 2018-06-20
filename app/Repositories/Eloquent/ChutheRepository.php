<?php namespace App\Repositories\Eloquent;

use \App\Repositories\ChutheRepositoryInterface;
use \App\Models\Chuthe;

class ChutheRepository extends SingleKeyModelRepository implements ChutheRepositoryInterface
{

    public function getBlankModel()
    {
        return new Chuthe();
    }

    public function rules()
    {
        return [
        ];
    }

    public function messages()
    {
        return [
        ];
    }

}
