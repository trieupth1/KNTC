<?php namespace Tests\Repositories;

use App\Models\Donvi;
use Tests\TestCase;

class DonviRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\DonviRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\DonviRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $donvis = factory(Donvi::class, 3)->create();
        $donviIds = $donvis->pluck('id')->toArray();

        /** @var  \App\Repositories\DonviRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\DonviRepositoryInterface::class);
        $this->assertNotNull($repository);

        $donvisCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Donvi::class, $donvisCheck[0]);

        $donvisCheck = $repository->getByIds($donviIds);
        $this->assertEquals(3, count($donvisCheck));
    }

    public function testFind()
    {
        $donvis = factory(Donvi::class, 3)->create();
        $donviIds = $donvis->pluck('id')->toArray();

        /** @var  \App\Repositories\DonviRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\DonviRepositoryInterface::class);
        $this->assertNotNull($repository);

        $donviCheck = $repository->find($donviIds[0]);
        $this->assertEquals($donviIds[0], $donviCheck->id);
    }

    public function testCreate()
    {
        $donviData = factory(Donvi::class)->make();

        /** @var  \App\Repositories\DonviRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\DonviRepositoryInterface::class);
        $this->assertNotNull($repository);

        $donviCheck = $repository->create($donviData->toFillableArray());
        $this->assertNotNull($donviCheck);
    }

    public function testUpdate()
    {
        $donviData = factory(Donvi::class)->create();

        /** @var  \App\Repositories\DonviRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\DonviRepositoryInterface::class);
        $this->assertNotNull($repository);

        $donviCheck = $repository->update($donviData, $donviData->toFillableArray());
        $this->assertNotNull($donviCheck);
    }

    public function testDelete()
    {
        $donviData = factory(Donvi::class)->create();

        /** @var  \App\Repositories\DonviRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\DonviRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($donviData);

        $donviCheck = $repository->find($donviData->id);
        $this->assertNull($donviCheck);
    }

}
