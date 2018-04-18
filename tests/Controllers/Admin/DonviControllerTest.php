<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class DonviControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\DonviController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\DonviController::class);
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
        $response = $this->action('GET', 'Admin\DonviController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\DonviController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $donvi = factory(\App\Models\Donvi::class)->make();
        $this->action('POST', 'Admin\DonviController@store', [
                '_token' => csrf_token(),
            ] + $donvi->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $donvi = factory(\App\Models\Donvi::class)->create();
        $this->action('GET', 'Admin\DonviController@show', [$donvi->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $donvi = factory(\App\Models\Donvi::class)->create();

        $name = $faker->name;
        $id = $donvi->id;

        $donvi->name = $name;

        $this->action('PUT', 'Admin\DonviController@update', [$id], [
                '_token' => csrf_token(),
            ] + $donvi->toArray());
        $this->assertResponseStatus(302);

        $newDonvi = \App\Models\Donvi::find($id);
        $this->assertEquals($name, $newDonvi->name);
    }

    public function testDeleteModel()
    {
        $donvi = factory(\App\Models\Donvi::class)->create();

        $id = $donvi->id;

        $this->action('DELETE', 'Admin\DonviController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkDonvi = \App\Models\Donvi::find($id);
        $this->assertNull($checkDonvi);
    }

}
