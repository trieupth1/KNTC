<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatehuongxuliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('huongxulies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('noidung');
            $table->unsignedBigInteger('don_id');

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('huongxulies', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('huongxulies');
    }
}
