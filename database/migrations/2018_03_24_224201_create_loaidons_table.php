<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateloaidonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loaidons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten');
            $table->string('mo_ta');
            $table->softDeletes();
            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('loaidons', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loaidons');
    }
}
