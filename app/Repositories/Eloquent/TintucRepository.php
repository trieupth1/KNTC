<?php namespace App\Repositories\Eloquent;

use \App\Repositories\TintucRepositoryInterface;
use \App\Models\Tintuc;

class TintucRepository extends SingleKeyModelRepository implements TintucRepositoryInterface
{

    public function getBlankModel()
    {
        return new Tintuc();
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
