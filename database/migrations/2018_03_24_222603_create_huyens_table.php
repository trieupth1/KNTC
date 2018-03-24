<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatehuyensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('huyens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten');
            $table->unsignedBigInteger('tinh_id');
            $table->softDeletes();

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('huyens', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('huyens');
    }
}
