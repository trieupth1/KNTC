<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\DonviRepositoryInterface;
use App\Http\Requests\Admin\DonviRequest;
use App\Http\Requests\PaginationRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DonviController extends Controller
{

    /** @var \App\Repositories\DonviRepositoryInterface */
    protected $donviRepository;


    public function __construct(
        DonviRepositoryInterface $donviRepository
    )
    {
        $this->donviRepository = $donviRepository;
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
        $paginate['baseUrl']    = action( 'Admin\DonviController@index' );

        $count = $this->donviRepository->count();
        $donvis = $this->donviRepository->get( $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit'] );

        return view(
            'pages.admin.' . config('view.admin') . '.donvis.index',
            [
                'donvis'    => $donvis,
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
            'pages.admin.' . config('view.admin') . '.donvis.edit',
            [
                'isNew'     => true,
                'donvi' => $this->donviRepository->getBlankModel(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(DonviRequest $request)
    {
        $input = $request->only(['tendonvi','tructhuoccap','diachi','phone']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $donvi = $this->donviRepository->create($input);

        if (empty( $donvi )) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\DonviController@index')
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
        $donvi = $this->donviRepository->find($id);
        if (empty( $donvi )) {
            abort(404);
        }

        return view(
            'pages.admin.' . config('view.admin') . '.donvis.edit',
            [
                'isNew' => false,
                'donvi' => $donvi,
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
    public function update($id, DonviRequest $request)
    {
        /** @var \App\Models\Donvi $donvi */
        $donvi = $this->donviRepository->find($id);
        if (empty( $donvi )) {
            abort(404);
        }
        $input = $request->only(['tendonvi','tructhuoccap','diachi','phone']);
        
        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->donviRepository->update($donvi, $input);

        return redirect()->action('Admin\DonviController@show', [$id])
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
        /** @var \App\Models\Donvi $donvi */
        $donvi = $this->donviRepository->find($id);
        if (empty( $donvi )) {
            abort(404);
        }
        $this->donviRepository->delete($donvi);

        return redirect()->action('Admin\DonviController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

    public function getAutocomplete(DonviRequest $requests){

        //return 1;
        $results = ['value'=>'aaaa'];
        $data = $this->donviRepository->getDonVi($requests->term);
        foreach ($data as $key => $value){
            $results[]=['value' =>$value->item];
        }
        //return response()->json($results);
        return Response::json($results);

    }

}
