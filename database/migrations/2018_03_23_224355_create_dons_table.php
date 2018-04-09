<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatedonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tieude');
            $table->string('sohieu');
            $table->date('ngayvietdon');
            $table->longText('noidung');
            $table->integer('loaidon_id')->comment('loai don');
            $table->unsignedBigInteger('admin_user_id')->default(0);
            $table->unsignedBigInteger('nhomdon_id')->default(0);
            $table->integer('hanxuly')->nullable();
            $table->unsignedBigInteger('don_quoc_gia_id')->default(0);
            $table->unsignedBigInteger('nguondon_id');
            $table->string('nguondon_type');

            $table->softDeletes();
            // Add some more columns
            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('dons', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dons');
    }
}
