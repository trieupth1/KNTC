<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\ChutheRepositoryInterface;
use App\Http\Requests\Admin\ChutheRequest;
use App\Http\Requests\PaginationRequest;

class ChutheController extends Controller
{

    /** @var \App\Repositories\ChutheRepositoryInterface */
    protected $chutheRepository;


    public function __construct(
        ChutheRepositoryInterface $chutheRepository
    )
    {
        $this->chutheRepository = $chutheRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\PaginationRequest $request
     * @return \Response
     */
    public function index(PaginationRequest $request)
    {
        $paginate['limit']      = $request->limit();
        $paginate['offset']     = $request->offset();
        $paginate['order']      = $request->order();
        $paginate['direction']  = $request->direction();
        $paginate['baseUrl']    = action( 'Admin\ChutheController@index' );

        $count = $this->chutheRepository->count();
        $chuthes = $this->chutheRepository->get( $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'] );

        return view(
            'pages.admin.' . config('view.admin') . '.chuthes.index',
            [
                'chuthes'    => $chuthes,
                'count'         => $count,
                'paginate'      => $paginate,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view(
            'pages.admin.' . config('view.admin') . '.chuthes.edit',
            [
                'isNew'     => true,
                'chuthe' => $this->chutheRepository->getBlankModel(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(ChutheRequest $request)
    {
        $input = $request->only(['ten','email','socmt','noicapcmt','ngaycapcmt','gioi_tinh','phone','ngay_sinh','dia_chi','loai_chu_the','hinhanh','languoidaidien']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $chuthe = $this->chutheRepository->create($input);

        if (empty( $chuthe )) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\ChutheController@index')
            ->with('message-success', trans('admin.messages.general.create_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Response
     */
    public function show($id)
    {
        $chuthe = $this->chutheRepository->find($id);
        if (empty( $chuthe )) {
            abort(404);
        }

        return view(
            'pages.admin.' . config('view.admin') . '.chuthes.edit',
            [
                'isNew' => false,
                'chuthe' => $chuthe,
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param      $request
     * @return \Response
     */
    public function update($id, ChutheRequest $request)
    {
        /** @var \App\Models\Chuthe $chuthe */
        $chuthe = $this->chutheRepository->find($id);
        if (empty( $chuthe )) {
            abort(404);
        }
        $input = $request->only(['ten','email','socmt','noicapcmt','ngaycapcmt','gioi_tinh','phone','ngay_sinh','dia_chi','loai_chu_the','hinhanh','languoidaidien']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->chutheRepository->update($chuthe, $input);

        return redirect()->action('Admin\ChutheController@show', [$id])
                    ->with('message-success', trans('admin.messages.general.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Response
     */
    public function destroy($id)
    {
        /** @var \App\Models\Chuthe $chuthe */
        $chuthe = $this->chutheRepository->find($id);
        if (empty( $chuthe )) {
            abort(404);
        }
        $this->chutheRepository->delete($chuthe);

        return redirect()->action('Admin\ChutheController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
