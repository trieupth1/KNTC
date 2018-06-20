<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class DonviguidonControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\DonviguidonController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\DonviguidonController::class);
        $this->assertNotNull($controller);
    }

    public function setUp()
    {
        parent::setUp();
        $authUser = \App\Models\AdminUser::first();
        $this->be($authUser, 'admins');
    }

    public function testGetList()
    {
        $response = $this->action('GET', 'Admin\DonviguidonController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\DonviguidonController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $donviguidon = factory(\App\Models\Donviguidon::class)->make();
        $this->action('POST', 'Admin\DonviguidonController@store', [
                '_token' => csrf_token(),
            ] + $donviguidon->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $donviguidon = factory(\App\Models\Donviguidon::class)->create();
        $this->action('GET', 'Admin\DonviguidonController@show', [$donviguidon->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $donviguidon = factory(\App\Models\Donviguidon::class)->create();

        $name = $faker->name;
        $id = $donviguidon->id;

        $donviguidon->name = $name;

        $this->action('PUT', 'Admin\DonviguidonController@update', [$id], [
                '_token' => csrf_token(),
            ] + $donviguidon->toArray());
        $this->assertResponseStatus(302);

        $newDonviguidon = \App\Models\Donviguidon::find($id);
        $this->assertEquals($name, $newDonviguidon->name);
    }

    public function testDeleteModel()
    {
        $donviguidon = factory(\App\Models\Donviguidon::class)->create();

        $id = $donviguidon->id;

        $this->action('DELETE', 'Admin\DonviguidonController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkDonviguidon = \App\Models\Donviguidon::find($id);
        $this->assertNull($checkDonviguidon);
    }

}
