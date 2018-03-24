<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatefiledinhkemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filedinhkems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tenfile');
            $table->unsignedBigInteger('don_id');
            $table->string('duongdan');
            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('filedinhkems', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filedinhkems');
    }
}
