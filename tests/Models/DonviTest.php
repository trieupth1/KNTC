<?php namespace Tests\Models;

use App\Models\Donvi;
use Tests\TestCase;

class DonviTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Donvi $donvi */
        $donvi = new Donvi();
        $this->assertNotNull($donvi);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Donvi $donvi */
        $donviModel = new Donvi();

        $donviData = factory(Donvi::class)->make();
        foreach( $donviData->toFillableArray() as $key => $value ) {
            $donviModel->$key = $value;
        }
        $donviModel->save();

        $this->assertNotNull(Donvi::find($donviModel->id));
    }

}
