<?php namespace Tests\Models;

use App\Models\Vanban;
use Tests\TestCase;

class VanbanTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Vanban $vanban */
        $vanban = new Vanban();
        $this->assertNotNull($vanban);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Vanban $vanban */
        $vanbanModel = new Vanban();

        $vanbanData = factory(Vanban::class)->make();
        foreach( $vanbanData->toFillableArray() as $key => $value ) {
            $vanbanModel->$key = $value;
        }
        $vanbanModel->save();

        $this->assertNotNull(Vanban::find($vanbanModel->id));
    }

}
