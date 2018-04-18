<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\DonviRepositoryInterface;

class DonviRequest extends BaseRequest
{

    /** @var \App\Repositories\DonviRepositoryInterface */
    protected $donviRepository;

    public function __construct(DonviRepositoryInterface $donviRepository)
    {
        $this->donviRepository = $donviRepository;
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
        return $this->donviRepository->rules();
    }

    public function messages()
    {
        return $this->donviRepository->messages();
    }

}
