<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\DonRepositoryInterface;

class DonRequest extends BaseRequest
{

    /** @var \App\Repositories\DonRepositoryInterface */
    protected $donRepository;

    public function __construct(DonRepositoryInterface $donRepository)
    {
        $this->donRepository = $donRepository;
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
        return $this->donRepository->rules();
    }

    public function messages()
    {
        return $this->donRepository->messages();
    }

}
