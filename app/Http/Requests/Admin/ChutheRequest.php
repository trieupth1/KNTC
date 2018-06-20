<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\ChutheRepositoryInterface;

class ChutheRequest extends BaseRequest
{

    /** @var \App\Repositories\ChutheRepositoryInterface */
    protected $chutheRepository;

    public function __construct(ChutheRepositoryInterface $chutheRepository)
    {
        $this->chutheRepository = $chutheRepository;
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
        return $this->chutheRepository->rules();
    }

    public function messages()
    {
        return $this->chutheRepository->messages();
    }

}
