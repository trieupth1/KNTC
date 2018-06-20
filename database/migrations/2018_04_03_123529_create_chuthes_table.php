<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatechuthesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chuthes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten')->default('');
            $table->string('email');
            $table->string('socmt');
            $table->string('noicapcmt');
            $table->date('ngaycapcmt');
            $table->smallInteger('gioi_tinh')->default(1);     // 1 = Ong, 0 = Ba
            $table->string('phone')->nullable()->default('');
            $table->date('ngay_sinh')->nullable()->default(null);
            $table->string('dia_chi')->nullable()->default('');
            $table->integer('loai_chu_the')->comment('1: ca nhan,2:tap the');
            $table->unsignedBigInteger('xa_id');
            $table->string('hinhanh');
            $table->integer('languoidaidien');
            $table->softDeletes();
            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('chuthes', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chuthes');
    }
}
