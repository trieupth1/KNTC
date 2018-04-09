<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class DonControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\DonController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\DonController::class);
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
        $response = $this->action('GET', 'Admin\DonController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\DonController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $don = factory(\App\Models\Don::class)->make();
        $this->action('POST', 'Admin\DonController@store', [
                '_token' => csrf_token(),
            ] + $don->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $don = factory(\App\Models\Don::class)->create();
        $this->action('GET', 'Admin\DonController@show', [$don->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $don = factory(\App\Models\Don::class)->create();

        $name = $faker->name;
        $id = $don->id;

        $don->name = $name;

        $this->action('PUT', 'Admin\DonController@update', [$id], [
                '_token' => csrf_token(),
            ] + $don->toArray());
        $this->assertResponseStatus(302);

        $newDon = \App\Models\Don::find($id);
        $this->assertEquals($name, $newDon->name);
    }

    public function testDeleteModel()
    {
        $don = factory(\App\Models\Don::class)->create();

        $id = $don->id;

        $this->action('DELETE', 'Admin\DonController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkDon = \App\Models\Don::find($id);
        $this->assertNull($checkDon);
    }

}
