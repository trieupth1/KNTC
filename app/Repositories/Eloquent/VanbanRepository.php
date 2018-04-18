<?php namespace App\Repositories\Eloquent;

use \App\Repositories\VanbanRepositoryInterface;
use \App\Models\Vanban;

class VanbanRepository extends SingleKeyModelRepository implements VanbanRepositoryInterface
{

    public function getBlankModel()
    {
        return new Vanban();
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
