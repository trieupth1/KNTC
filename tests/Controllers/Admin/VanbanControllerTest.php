<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class VanbanControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\VanbanController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\VanbanController::class);
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
        $response = $this->action('GET', 'Admin\VanbanController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\VanbanController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $vanban = factory(\App\Models\Vanban::class)->make();
        $this->action('POST', 'Admin\VanbanController@store', [
                '_token' => csrf_token(),
            ] + $vanban->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $vanban = factory(\App\Models\Vanban::class)->create();
        $this->action('GET', 'Admin\VanbanController@show', [$vanban->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $vanban = factory(\App\Models\Vanban::class)->create();

        $name = $faker->name;
        $id = $vanban->id;

        $vanban->name = $name;

        $this->action('PUT', 'Admin\VanbanController@update', [$id], [
                '_token' => csrf_token(),
            ] + $vanban->toArray());
        $this->assertResponseStatus(302);

        $newVanban = \App\Models\Vanban::find($id);
        $this->assertEquals($name, $newVanban->name);
    }

    public function testDeleteModel()
    {
        $vanban = factory(\App\Models\Vanban::class)->create();

        $id = $vanban->id;

        $this->action('DELETE', 'Admin\VanbanController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkVanban = \App\Models\Vanban::find($id);
        $this->assertNull($checkVanban);
    }

}
