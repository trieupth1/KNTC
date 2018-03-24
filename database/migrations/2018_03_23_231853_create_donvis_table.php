<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatedonvisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donvis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tendonvi');
            $table->integer('tructhuoccap');
            $table->string('diachi');
            $table->string('phone');

            // Add some more columns

            $table->timestamps();
            $table->unique(['tendonvi','tructhuoccap']);
        });

        $this->updateTimestampDefaultValue('donvis', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donvis');
    }
}
