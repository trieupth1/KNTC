<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatenhomdonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhomdons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten');
            $table->softDeletes();
            // Add some more columns

            $table->timestamps();

            //ADD index
            $table->unique('ten');
        });

        $this->updateTimestampDefaultValue('nhomdons', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nhomdons');
    }
}
