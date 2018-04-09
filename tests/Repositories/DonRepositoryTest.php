<?php namespace Tests\Repositories;

use App\Models\Don;
use Tests\TestCase;

class DonRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\DonRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\DonRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $dons = factory(Don::class, 3)->create();
        $donIds = $dons->pluck('id')->toArray();

        /** @var  \App\Repositories\DonRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\DonRepositoryInterface::class);
        $this->assertNotNull($repository);

        $donsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Don::class, $donsCheck[0]);

        $donsCheck = $repository->getByIds($donIds);
        $this->assertEquals(3, count($donsCheck));
    }

    public function testFind()
    {
        $dons = factory(Don::class, 3)->create();
        $donIds = $dons->pluck('id')->toArray();

        /** @var  \App\Repositories\DonRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\DonRepositoryInterface::class);
        $this->assertNotNull($repository);

        $donCheck = $repository->find($donIds[0]);
        $this->assertEquals($donIds[0], $donCheck->id);
    }

    public function testCreate()
    {
        $donData = factory(Don::class)->make();

        /** @var  \App\Repositories\DonRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\DonRepositoryInterface::class);
        $this->assertNotNull($repository);

        $donCheck = $repository->create($donData->toFillableArray());
        $this->assertNotNull($donCheck);
    }

    public function testUpdate()
    {
        $donData = factory(Don::class)->create();

        /** @var  \App\Repositories\DonRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\DonRepositoryInterface::class);
        $this->assertNotNull($repository);

        $donCheck = $repository->update($donData, $donData->toFillableArray());
        $this->assertNotNull($donCheck);
    }

    public function testDelete()
    {
        $donData = factory(Don::class)->create();

        /** @var  \App\Repositories\DonRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\DonRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($donData);

        $donCheck = $repository->find($donData->id);
        $this->assertNull($donCheck);
    }

}
