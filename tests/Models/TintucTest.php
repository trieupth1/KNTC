<?php namespace Tests\Models;

use App\Models\Tintuc;
use Tests\TestCase;

class TintucTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Models\Tintuc $tintuc */
        $tintuc = new Tintuc();
        $this->assertNotNull($tintuc);
    }

    public function testStoreNew()
    {
        /** @var  \App\Models\Tintuc $tintuc */
        $tintucModel = new Tintuc();

        $tintucData = factory(Tintuc::class)->make();
        foreach( $tintucData->toFillableArray() as $key => $value ) {
            $tintucModel->$key = $value;
        }
        $tintucModel->save();

        $this->assertNotNull(Tintuc::find($tintucModel->id));
    }

}
