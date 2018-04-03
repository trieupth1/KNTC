<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatethongbaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thongbaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten')->comment('ten thong bao');
            $table->dateTime('ngay_ban_hanh');
            $table->longText('noi_dung');

            $table->softDeletes();

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('thongbaos', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thongbaos');
    }
}
