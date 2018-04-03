<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatenguondonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nguondons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('chuthe_id');
            $table->unsignedBigInteger('don_id');
            $table->unsignedBigInteger('donviguidon_id');
            $table->softDeletes();

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('nguondons', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nguondons');
    }
}
