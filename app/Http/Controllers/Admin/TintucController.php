<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\TintucRepositoryInterface;
use App\Http\Requests\Admin\TintucRequest;
use App\Http\Requests\PaginationRequest;

class TintucController extends Controller
{

    /** @var \App\Repositories\TintucRepositoryInterface */
    protected $tintucRepository;


    public function __construct(
        TintucRepositoryInterface $tintucRepository
    )
    {
        $this->tintucRepository = $tintucRepository;
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
        $paginate['baseUrl']    = action( 'Admin\TintucController@index' );

        $count = $this->tintucRepository->count();
        $tintucs = $this->tintucRepository->get( $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'] );

        return view(
            'pages.admin.' . config('view.admin') . '.tintucs.index',
            [
                'tintucs'    => $tintucs,
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
            'pages.admin.' . config('view.admin') . '.tintucs.edit',
            [
                'isNew'     => true,
                'tintuc' => $this->tintucRepository->getBlankModel(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(TintucRequest $request)
    {
        $input = $request->only(['tieu_de','ngay_dang','the_loai','nguon_tin','tom_tat','noi_dung','trang_thai']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $tintuc = $this->tintucRepository->create($input);

        if (empty( $tintuc )) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\TintucController@index')
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
        $tintuc = $this->tintucRepository->find($id);
        if (empty( $tintuc )) {
            abort(404);
        }

        return view(
            'pages.admin.' . config('view.admin') . '.tintucs.edit',
            [
                'isNew' => false,
                'tintuc' => $tintuc,
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
    public function update($id, TintucRequest $request)
    {
        /** @var \App\Models\Tintuc $tintuc */
        $tintuc = $this->tintucRepository->find($id);
        if (empty( $tintuc )) {
            abort(404);
        }
        $input = $request->only(['tieu_de','ngay_dang','the_loai','nguon_tin','tom_tat','noi_dung','trang_thai']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->tintucRepository->update($tintuc, $input);

        return redirect()->action('Admin\TintucController@show', [$id])
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
        /** @var \App\Models\Tintuc $tintuc */
        $tintuc = $this->tintucRepository->find($id);
        if (empty( $tintuc )) {
            abort(404);
        }
        $this->tintucRepository->delete($tintuc);

        return redirect()->action('Admin\TintucController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
