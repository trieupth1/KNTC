<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatetinhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tinhs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten');
            // Add some more columns
            $table->softDeletes();
            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('tinhs', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tinhs');
    }
}
