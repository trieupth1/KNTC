<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class ChutheControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\ChutheController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\ChutheController::class);
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
        $response = $this->action('GET', 'Admin\ChutheController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\ChutheController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $chuthe = factory(\App\Models\Chuthe::class)->make();
        $this->action('POST', 'Admin\ChutheController@store', [
                '_token' => csrf_token(),
            ] + $chuthe->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $chuthe = factory(\App\Models\Chuthe::class)->create();
        $this->action('GET', 'Admin\ChutheController@show', [$chuthe->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $chuthe = factory(\App\Models\Chuthe::class)->create();

        $name = $faker->name;
        $id = $chuthe->id;

        $chuthe->name = $name;

        $this->action('PUT', 'Admin\ChutheController@update', [$id], [
                '_token' => csrf_token(),
            ] + $chuthe->toArray());
        $this->assertResponseStatus(302);

        $newChuthe = \App\Models\Chuthe::find($id);
        $this->assertEquals($name, $newChuthe->name);
    }

    public function testDeleteModel()
    {
        $chuthe = factory(\App\Models\Chuthe::class)->create();

        $id = $chuthe->id;

        $this->action('DELETE', 'Admin\ChutheController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkChuthe = \App\Models\Chuthe::find($id);
        $this->assertNull($checkChuthe);
    }

}
