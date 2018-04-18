<?php namespace Tests\Repositories;

use App\Models\Vanban;
use Tests\TestCase;

class VanbanRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\VanbanRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\VanbanRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $vanbans = factory(Vanban::class, 3)->create();
        $vanbanIds = $vanbans->pluck('id')->toArray();

        /** @var  \App\Repositories\VanbanRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\VanbanRepositoryInterface::class);
        $this->assertNotNull($repository);

        $vanbansCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Vanban::class, $vanbansCheck[0]);

        $vanbansCheck = $repository->getByIds($vanbanIds);
        $this->assertEquals(3, count($vanbansCheck));
    }

    public function testFind()
    {
        $vanbans = factory(Vanban::class, 3)->create();
        $vanbanIds = $vanbans->pluck('id')->toArray();

        /** @var  \App\Repositories\VanbanRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\VanbanRepositoryInterface::class);
        $this->assertNotNull($repository);

        $vanbanCheck = $repository->find($vanbanIds[0]);
        $this->assertEquals($vanbanIds[0], $vanbanCheck->id);
    }

    public function testCreate()
    {
        $vanbanData = factory(Vanban::class)->make();

        /** @var  \App\Repositories\VanbanRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\VanbanRepositoryInterface::class);
        $this->assertNotNull($repository);

        $vanbanCheck = $repository->create($vanbanData->toFillableArray());
        $this->assertNotNull($vanbanCheck);
    }

    public function testUpdate()
    {
        $vanbanData = factory(Vanban::class)->create();

        /** @var  \App\Repositories\VanbanRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\VanbanRepositoryInterface::class);
        $this->assertNotNull($repository);

        $vanbanCheck = $repository->update($vanbanData, $vanbanData->toFillableArray());
        $this->assertNotNull($vanbanCheck);
    }

    public function testDelete()
    {
        $vanbanData = factory(Vanban::class)->create();

        /** @var  \App\Repositories\VanbanRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\VanbanRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($vanbanData);

        $vanbanCheck = $repository->find($vanbanData->id);
        $this->assertNull($vanbanCheck);
    }

}
