<?php namespace Tests\Models;

use App\Models\Chuthe;
use Tests\TestCase;

class ChutheTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Chuthe $chuthe */
        $chuthe = new Chuthe();
        $this->assertNotNull($chuthe);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Chuthe $chuthe */
        $chutheModel = new Chuthe();

        $chutheData = factory(Chuthe::class)->make();
        foreach( $chutheData->toFillableArray() as $key => $value ) {
            $chutheModel->$key = $value;
        }
        $chutheModel->save();

        $this->assertNotNull(Chuthe::find($chutheModel->id));
    }

}
