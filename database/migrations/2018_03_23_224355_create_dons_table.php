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
            $table->integer('nguondon')->comment('nguon don gui den: 1 dan chuyen den, 2 co quan don vi');
            $table->integer('chuthe')->comment('chu the: 1 ca nhan, 2 tap the');
            $table->integer('loaidon_id')->comment('loai don');
            $table->unsignedBigInteger('admin_user_id')->default(0);
            $table->unsignedBigInteger('nhomdon_id')->default(0);
            $table->integer('hanxuly')->nullable();
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
