<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\VanbanRepositoryInterface;

class VanbanRequest extends BaseRequest
{

    /** @var \App\Repositories\VanbanRepositoryInterface */
    protected $vanbanRepository;

    public function __construct(VanbanRepositoryInterface $vanbanRepository)
    {
        $this->vanbanRepository = $vanbanRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->vanbanRepository->rules();
    }

    public function messages()
    {
        return $this->vanbanRepository->messages();
    }

}
