<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\DonviRepositoryInterface;
use App\Repositories\VanbanRepositoryInterface;
use App\Http\Requests\Admin\VanbanRequest;
use App\Http\Requests\PaginationRequest;
use View;

class VanbanController extends Controller
{

    /** @var \App\Repositories\VanbanRepositoryInterface */
    protected $vanbanRepository;
    protected $donviRepository;


    public function __construct(
        VanbanRepositoryInterface $vanbanRepository,
        DonviRepositoryInterface $donviRepository
    )
    {
        $this->vanbanRepository = $vanbanRepository;
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
        $paginate['limit'] = $request->limit();
        $paginate['offset'] = $request->offset();
        $paginate['order'] = $request->order();
        $paginate['direction'] = $request->direction();
        $paginate['baseUrl'] = action('Admin\VanbanController@index');

        $count = $this->vanbanRepository->count();
        $vanbans = $this->vanbanRepository->get($paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit']);

        return view(
            'pages.admin.' . config('view.admin') . '.vanbans.index',
            [
                'vanbans' => $vanbans,
                'count' => $count,
                'paginate' => $paginate,
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
            'pages.admin.' . config('view.admin') . '.vanbans.edit',
            [
                'isNew' => true,
                'vanban' => $this->vanbanRepository->getBlankModel(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     * @return \Response
     */
    public function store(VanbanRequest $request)
    {
        $input = $request->only([
            'ten',
            'so_hieu',
            'trich_dan',
            'loai_van_ban',
            'nguoi_ky',
            'doi_tuong_lien_quan_1',
            'doi_tuong_lien_quan_2',
            'doi_tuong_lien_quan_3',
            'doi_tuong_lien_quan_4',
            'doi_tuong_lien_quan_5'
        ]);


        if (!empty($request->donvi_id)) {
            $input['donvi_id'] = (int)$request->donvi_id;
        }

        $ngay_ban_hanh = str_replace('/', '-', $request->ngay_ban_hanh);
        $ngay_nhan= str_replace('/', '-', $request->ngay_nhan);

        $input['ngay_ban_hanh'] = date('Y-m-d H:i:s', strtotime($ngay_ban_hanh));
        $input['ngay_nhan'] = date('Y-m-d H:i:s', strtotime($ngay_nhan));
        $input['is_enabled'] = $request->get('is_enabled', 0);

        $vanban = $this->vanbanRepository->create($input);

        if (empty($vanban)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\VanbanController@index')
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

        $vanban = $this->vanbanRepository->find($id);
        if (empty($vanban)) {
            abort(404);
        }

        return view(
            'pages.admin.' . config('view.admin') . '.vanbans.edit',
            [
                'isNew' => false,
                'vanban' => $vanban,
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
    public function update($id, VanbanRequest $request)
    {
        /** @var \App\Models\Vanban $vanban */
        $vanban = $this->vanbanRepository->find($id);
        if (empty($vanban)) {
            abort(404);
        }
        $input = $request->only(['ten', 'so_hieu', 'trich_dan', 'ngay_ban_hanh', 'ngay_nhan', 'loai_van_ban', 'nguoi_ky']);

        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->vanbanRepository->update($vanban, $input);

        return redirect()->action('Admin\VanbanController@show', [$id])
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
        /** @var \App\Models\Vanban $vanban */
        $vanban = $this->vanbanRepository->find($id);
        if (empty($vanban)) {
            abort(404);
        }
        $this->vanbanRepository->delete($vanban);

        return redirect()->action('Admin\VanbanController@index')
            ->with('message-success', trans('admin.messages.general.delete_success'));
    }

    public function vanBanAutocomplete(VanbanRequest $request)
    {
        $result = $this->donviRepository->getDonVi($request->key_word);
        return View::make('pages.admin.' . config('view.admin') . '.component.suggest', ['data' => $result, 'key' => $request->key_word, 'id' => $request->id])->render();
    }

}
