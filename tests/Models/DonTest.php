<?php namespace Tests\Models;

use App\Models\Don;
use Tests\TestCase;

class DonTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Don $don */
        $don = new Don();
        $this->assertNotNull($don);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Don $don */
        $donModel = new Don();

        $donData = factory(Don::class)->make();
        foreach( $donData->toFillableArray() as $key => $value ) {
            $donModel->$key = $value;
        }
        $donModel->save();

        $this->assertNotNull(Don::find($donModel->id));
    }

}
