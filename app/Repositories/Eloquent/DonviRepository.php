<?php namespace App\Repositories\Eloquent;

use \App\Repositories\DonviRepositoryInterface;
use \App\Models\Donvi;
use Illuminate\Support\Facades\Response;


class DonviRepository extends SingleKeyModelRepository implements DonviRepositoryInterface
{

    public function getBlankModel()
    {
        return new Donvi();
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

    public function getDonVi($nameDV){
        $model = $this->getBlankModel();

        $data = $model::where('tendonvi','like','%'.$nameDV.'%')->take(10)->get();

        return $data;

    }

}
