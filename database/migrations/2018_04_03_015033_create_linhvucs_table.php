<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatelinhvucsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linhvucs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten')->comment('ten linh vuc');
            $table->string('viet_tat');
            $table->softDeletes();

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('linhvucs', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('linhvucs');
    }
}
