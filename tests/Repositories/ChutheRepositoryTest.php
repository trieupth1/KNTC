<?php namespace Tests\Repositories;

use App\Models\Chuthe;
use Tests\TestCase;

class ChutheRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Repositories\ChutheRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ChutheRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $chuthes = factory(Chuthe::class, 3)->create();
        $chutheIds = $chuthes->pluck('id')->toArray();

        /** @var  \App\Repositories\ChutheRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ChutheRepositoryInterface::class);
        $this->assertNotNull($repository);

        $chuthesCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(Chuthe::class, $chuthesCheck[0]);

        $chuthesCheck = $repository->getByIds($chutheIds);
        $this->assertEquals(3, count($chuthesCheck));
    }

    public function testFind()
    {
        $chuthes = factory(Chuthe::class, 3)->create();
        $chutheIds = $chuthes->pluck('id')->toArray();

        /** @var  \App\Repositories\ChutheRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ChutheRepositoryInterface::class);
        $this->assertNotNull($repository);

        $chutheCheck = $repository->find($chutheIds[0]);
        $this->assertEquals($chutheIds[0], $chutheCheck->id);
    }

    public function testCreate()
    {
        $chutheData = factory(Chuthe::class)->make();

        /** @var  \App\Repositories\ChutheRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ChutheRepositoryInterface::class);
        $this->assertNotNull($repository);

        $chutheCheck = $repository->create($chutheData->toFillableArray());
        $this->assertNotNull($chutheCheck);
    }

    public function testUpdate()
    {
        $chutheData = factory(Chuthe::class)->create();

        /** @var  \App\Repositories\ChutheRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ChutheRepositoryInterface::class);
        $this->assertNotNull($repository);

        $chutheCheck = $repository->update($chutheData, $chutheData->toFillableArray());
        $this->assertNotNull($chutheCheck);
    }

    public function testDelete()
    {
        $chutheData = factory(Chuthe::class)->create();

        /** @var  \App\Repositories\ChutheRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\ChutheRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($chutheData);

        $chutheCheck = $repository->find($chutheData->id);
        $this->assertNull($chutheCheck);
    }

}
