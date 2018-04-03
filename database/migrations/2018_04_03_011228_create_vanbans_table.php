<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatevanbansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vanbans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten')->comment('ten van ban');
            $table->string('so_hieu');
            $table->string('trich_dan');
            $table->dateTime('ngay_ban_hanh')->comment('ngay ban hanh');
            $table->dateTime('ngay_nhan')->comment('ngay nhan van ban');
            $table->integer('loai_van_ban')->comment('laoi van ban');
            $table->unsignedBigInteger('don_id')->comment('don lien quan');
            $table->unsignedBigInteger('admin_user_id')->comment('chuyen can bo');
            //$table->unsignedBigInteger('canbo_admin_user_id')->comment('chuyen can bo');
            $table->string('nguoi_ky')->comment('nguoi ky');
            $table->unsignedBigInteger('donvi_id')->comment('don vi gui don');

            $table->softDeletes();
            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('vanbans', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vanbans');
    }
}
