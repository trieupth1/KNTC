<?php namespace Tests\Repositories;

use App\Models\Tintuc;
use Tests\TestCase;

class TintucRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\TintucRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TintucRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $tintucs = factory(Tintuc::class, 3)->create();
        $tintucIds = $tintucs->pluck('id')->toArray();

        /** @var  \App\Repositories\TintucRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TintucRepositoryInterface::class);
        $this->assertNotNull($repository);

        $tintucsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Tintuc::class, $tintucsCheck[0]);

        $tintucsCheck = $repository->getByIds($tintucIds);
        $this->assertEquals(3, count($tintucsCheck));
    }

    public function testFind()
    {
        $tintucs = factory(Tintuc::class, 3)->create();
        $tintucIds = $tintucs->pluck('id')->toArray();

        /** @var  \App\Repositories\TintucRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TintucRepositoryInterface::class);
        $this->assertNotNull($repository);

        $tintucCheck = $repository->find($tintucIds[0]);
        $this->assertEquals($tintucIds[0], $tintucCheck->id);
    }

    public function testCreate()
    {
        $tintucData = factory(Tintuc::class)->make();

        /** @var  \App\Repositories\TintucRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TintucRepositoryInterface::class);
        $this->assertNotNull($repository);

        $tintucCheck = $repository->create($tintucData->toFillableArray());
        $this->assertNotNull($tintucCheck);
    }

    public function testUpdate()
    {
        $tintucData = factory(Tintuc::class)->create();

        /** @var  \App\Repositories\TintucRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TintucRepositoryInterface::class);
        $this->assertNotNull($repository);

        $tintucCheck = $repository->update($tintucData, $tintucData->toFillableArray());
        $this->assertNotNull($tintucCheck);
    }

    public function testDelete()
    {
        $tintucData = factory(Tintuc::class)->create();

        /** @var  \App\Repositories\TintucRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\TintucRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($tintucData);

        $tintucCheck = $repository->find($tintucData->id);
        $this->assertNull($tintucCheck);
    }

}
