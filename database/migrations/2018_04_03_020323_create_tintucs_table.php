<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatetintucsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tintucs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tieu_de');
            $table->dateTime('ngay_dang');
            $table->integer('the_loai')->comment('1:kntc,2:tiep cong dan;3:hoat dong');
            $table->string('nguon_tin');
            $table->unsignedBigInteger('image_id');
            $table->string('tom_tat');
            $table->longText('noi_dung');
            $table->integer('trang_thai')->comment('1: display; 2: hide');
            $table->softDeletes();

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('tintucs', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tintucs');
    }
}
