<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatedoituonglienquansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doituonglienquans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten')->comment('ten doi tuong lien quan');
            $table->unsignedBigInteger('vanban_id')->comment('van ban id');

            $table->softDeletes();
            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('doituonglienquans', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doituonglienquans');
    }
}
