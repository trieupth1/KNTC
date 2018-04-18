<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class TintucControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\TintucController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\TintucController::class);
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
        $response = $this->action('GET', 'Admin\TintucController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\TintucController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $tintuc = factory(\App\Models\Tintuc::class)->make();
        $this->action('POST', 'Admin\TintucController@store', [
                '_token' => csrf_token(),
            ] + $tintuc->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $tintuc = factory(\App\Models\Tintuc::class)->create();
        $this->action('GET', 'Admin\TintucController@show', [$tintuc->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $tintuc = factory(\App\Models\Tintuc::class)->create();

        $name = $faker->name;
        $id = $tintuc->id;

        $tintuc->name = $name;

        $this->action('PUT', 'Admin\TintucController@update', [$id], [
                '_token' => csrf_token(),
            ] + $tintuc->toArray());
        $this->assertResponseStatus(302);

        $newTintuc = \App\Models\Tintuc::find($id);
        $this->assertEquals($name, $newTintuc->name);
    }

    public function testDeleteModel()
    {
        $tintuc = factory(\App\Models\Tintuc::class)->create();

        $id = $tintuc->id;

        $this->action('DELETE', 'Admin\TintucController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkTintuc = \App\Models\Tintuc::find($id);
        $this->assertNull($checkTintuc);
    }

}
