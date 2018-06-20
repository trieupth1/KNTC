<?php namespace App\Repositories\Eloquent;

use \App\Repositories\DonviguidonRepositoryInterface;
use \App\Models\Donviguidon;

class DonviguidonRepository extends SingleKeyModelRepository implements DonviguidonRepositoryInterface
{

    public function getBlankModel()
    {
        return new Donviguidon();
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
