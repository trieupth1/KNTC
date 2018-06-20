<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\DonviguidonRepositoryInterface;

class DonviguidonRequest extends BaseRequest
{

    /** @var \App\Repositories\DonviguidonRepositoryInterface */
    protected $donviguidonRepository;

    public function __construct(DonviguidonRepositoryInterface $donviguidonRepository)
    {
        $this->donviguidonRepository = $donviguidonRepository;
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
        return $this->donviguidonRepository->rules();
    }

    public function messages()
    {
        return $this->donviguidonRepository->messages();
    }

}
