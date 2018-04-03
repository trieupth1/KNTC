<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatedonlienquansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donlienquans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten')->comment('ten don lien quan');
            $table->unsignedBigInteger('don_id')->comment('id don kntc');
            $table->softDeletes();
            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('donlienquans', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donlienquans');
    }
}
