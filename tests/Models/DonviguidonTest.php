<?php namespace Tests\Models;

use App\Models\Donviguidon;
use Tests\TestCase;

class DonviguidonTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Donviguidon $donviguidon */
        $donviguidon = new Donviguidon();
        $this->assertNotNull($donviguidon);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Donviguidon $donviguidon */
        $donviguidonModel = new Donviguidon();

        $donviguidonData = factory(Donviguidon::class)->make();
        foreach( $donviguidonData->toFillableArray() as $key => $value ) {
            $donviguidonModel->$key = $value;
        }
        $donviguidonModel->save();

        $this->assertNotNull(Donviguidon::find($donviguidonModel->id));
    }

}
