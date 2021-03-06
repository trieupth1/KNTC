<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\TintucRepositoryInterface;

class TintucRequest extends BaseRequest
{

    /** @var \App\Repositories\TintucRepositoryInterface */
    protected $tintucRepository;

    public function __construct(TintucRepositoryInterface $tintucRepository)
    {
        $this->tintucRepository = $tintucRepository;
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
        return $this->tintucRepository->rules();
    }

    public function messages()
    {
        return $this->tintucRepository->messages();
    }

}
