<?php namespace App\Repositories\Eloquent;

use \App\Repositories\DonRepositoryInterface;
use \App\Models\Don;

class DonRepository extends SingleKeyModelRepository implements DonRepositoryInterface
{

    public function getBlankModel()
    {
        return new Don();
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
