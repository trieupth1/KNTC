<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatenguoiguisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nguoiguis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten')->default('');
            $table->string('email');
            $table->string('socmt');
            $table->smallInteger('gioitinh')->default(1);     // 1 = Ong, 0 = Ba
            $table->string('phone')->nullable()->default('');
            $table->date('ngaysinh')->nullable()->default(null);
            $table->string('diachi')->nullable()->default('');
            $table->unsignedBigInteger('tinh_id');
            $table->unsignedBigInteger('huyen_id');
            $table->unsignedBigInteger('xa_id');

            $table->softDeletes();
            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('nguoiguis', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nguoiguis');
    }
}
