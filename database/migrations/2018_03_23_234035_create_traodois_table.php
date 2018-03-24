<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatetraodoisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traodois', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('noidung');
            $table->unsignedBigInteger('admin_user_id');
            $table->unsignedBigInteger('don_id');

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('traodois', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traodois');
    }
}
