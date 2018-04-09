<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\DonRepositoryInterface;
use App\Http\Requests\Admin\DonRequest;
use App\Http\Requests\PaginationRequest;

class DonController extends Controller
{

    /** @var \App\Repositories\DonRepositoryInterface */
    protected $donRepository;


    public function __construct(
        DonRepositoryInterface $donRepository
    )
    {
        $this->donRepository = $donRepository;
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
        $paginate['baseUrl']    = action( 'Admin\DonController@index' );

        $count = $this->donRepository->count();
        $dons = $this->donRepository->get( $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'] );

        return view(
            'pages.admin.' . config('view.admin') . '.dons.index',
            [
                'dons'    => $dons,
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
            'pages.admin.' . config('view.admin') . '.dons.edit',
            [
                'isNew'     => true,
                'don' => $this->donRepository->getBlankModel(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(DonRequest $request)
    {
        $input = $request->only(['tieude','sohieu','ngayvietdon','noidung','hanxuly','nguondon_type']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $don = $this->donRepository->create($input);

        if (empty( $don )) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\DonController@index')
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
        $don = $this->donRepository->find($id);
        if (empty( $don )) {
            abort(404);
        }

        return view(
            'pages.admin.' . config('view.admin') . '.dons.edit',
            [
                'isNew' => false,
                'don' => $don,
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
    public function update($id, DonRequest $request)
    {
        /** @var \App\Models\Don $don */
        $don = $this->donRepository->find($id);
        if (empty( $don )) {
            abort(404);
        }
        $input = $request->only(['tieude','sohieu','ngayvietdon','noidung','hanxuly','nguondon_type']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->donRepository->update($don, $input);

        return redirect()->action('Admin\DonController@show', [$id])
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
        /** @var \App\Models\Don $don */
        $don = $this->donRepository->find($id);
        if (empty( $don )) {
            abort(404);
        }
        $this->donRepository->delete($don);

        return redirect()->action('Admin\DonController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
