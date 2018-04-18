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
    
    public function getDSDon($order, $direction, $offset, $limit,$input){

        $skip = ($offset - 1)*$limit;
        $query = $this->getBlankModel;
        
        if($input == Don::DON_CHO_XU_LY){
            $query->where('status',Don::DON_CHO_XU_LY);
        }

        $query->take($limit);
        $query->skip($skip);


        $data = $query->orderBy($order, $direction)->skip($offset)->take($limit)->get();

        return $data;
        
    }

}
