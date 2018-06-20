<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\DonviguidonRepositoryInterface;
use App\Http\Requests\Admin\DonviguidonRequest;
use App\Http\Requests\PaginationRequest;

class DonviguidonController extends Controller
{

    /** @var \App\Repositories\DonviguidonRepositoryInterface */
    protected $donviguidonRepository;


    public function __construct(
        DonviguidonRepositoryInterface $donviguidonRepository
    )
    {
        $this->donviguidonRepository = $donviguidonRepository;
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
        $paginate['baseUrl']    = action( 'Admin\DonviguidonController@index' );

        $count = $this->donviguidonRepository->count();
        $donviguidons = $this->donviguidonRepository->get( $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'] );

        return view(
            'pages.admin.' . config('view.admin') . '.donviguidons.index',
            [
                'donviguidons'    => $donviguidons,
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
            'pages.admin.' . config('view.admin') . '.donviguidons.edit',
            [
                'isNew'     => true,
                'donviguidon' => $this->donviguidonRepository->getBlankModel(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(DonviguidonRequest $request)
    {
        $input = $request->only(['sokyhieu','ngaybanhanh']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $donviguidon = $this->donviguidonRepository->create($input);

        if (empty( $donviguidon )) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\DonviguidonController@index')
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
        $donviguidon = $this->donviguidonRepository->find($id);
        if (empty( $donviguidon )) {
            abort(404);
        }

        return view(
            'pages.admin.' . config('view.admin') . '.donviguidons.edit',
            [
                'isNew' => false,
                'donviguidon' => $donviguidon,
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
    public function update($id, DonviguidonRequest $request)
    {
        /** @var \App\Models\Donviguidon $donviguidon */
        $donviguidon = $this->donviguidonRepository->find($id);
        if (empty( $donviguidon )) {
            abort(404);
        }
        $input = $request->only(['sokyhieu','ngaybanhanh']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->donviguidonRepository->update($donviguidon, $input);

        return redirect()->action('Admin\DonviguidonController@show', [$id])
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
        /** @var \App\Models\Donviguidon $donviguidon */
        $donviguidon = $this->donviguidonRepository->find($id);
        if (empty( $donviguidon )) {
            abort(404);
        }
        $this->donviguidonRepository->delete($donviguidon);

        return redirect()->action('Admin\DonviguidonController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
