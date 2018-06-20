<?php namespace Tests\Repositories;

use App\Models\Donviguidon;
use Tests\TestCase;

class DonviguidonRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\DonviguidonRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\DonviguidonRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $donviguidons = factory(Donviguidon::class, 3)->create();
        $donviguidonIds = $donviguidons->pluck('id')->toArray();

        /** @var  \App\Repositories\DonviguidonRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\DonviguidonRepositoryInterface::class);
        $this->assertNotNull($repository);

        $donviguidonsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Donviguidon::class, $donviguidonsCheck[0]);

        $donviguidonsCheck = $repository->getByIds($donviguidonIds);
        $this->assertEquals(3, count($donviguidonsCheck));
    }

    public function testFind()
    {
        $donviguidons = factory(Donviguidon::class, 3)->create();
        $donviguidonIds = $donviguidons->pluck('id')->toArray();

        /** @var  \App\Repositories\DonviguidonRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\DonviguidonRepositoryInterface::class);
        $this->assertNotNull($repository);

        $donviguidonCheck = $repository->find($donviguidonIds[0]);
        $this->assertEquals($donviguidonIds[0], $donviguidonCheck->id);
    }

    public function testCreate()
    {
        $donviguidonData = factory(Donviguidon::class)->make();

        /** @var  \App\Repositories\DonviguidonRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\DonviguidonRepositoryInterface::class);
        $this->assertNotNull($repository);

        $donviguidonCheck = $repository->create($donviguidonData->toFillableArray());
        $this->assertNotNull($donviguidonCheck);
    }

    public function testUpdate()
    {
        $donviguidonData = factory(Donviguidon::class)->create();

        /** @var  \App\Repositories\DonviguidonRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\DonviguidonRepositoryInterface::class);
        $this->assertNotNull($repository);

        $donviguidonCheck = $repository->update($donviguidonData, $donviguidonData->toFillableArray());
        $this->assertNotNull($donviguidonCheck);
    }

    public function testDelete()
    {
        $donviguidonData = factory(Donviguidon::class)->create();

        /** @var  \App\Repositories\DonviguidonRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\DonviguidonRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($donviguidonData);

        $donviguidonCheck = $repository->find($donviguidonData->id);
        $this->assertNull($donviguidonCheck);
    }

}
