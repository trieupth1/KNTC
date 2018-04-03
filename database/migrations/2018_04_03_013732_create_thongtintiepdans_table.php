<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatethongtintiepdansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thongtintiepdans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('so_hieu')->comment('so hieu');
            $table->dateTime('ngay_ban_hanh');
            $table->string('trich_dan');
            $table->longText('noi_dung');
            $table->unsignedBigInteger('donvi_id')->comment('co quan ban hanh');

            $table->softDeletes();

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('thongtintiepdans', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thongtintiepdans');
    }
}
