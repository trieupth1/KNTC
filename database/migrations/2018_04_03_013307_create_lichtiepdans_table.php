<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatelichtiepdansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lichtiepdans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dia_diem')->comment('dia diem tiep dan');
            $table->dateTime('ngay_tiep')->comment('ngay tiep dan');
            $table->integer('dot_xuat')->comment('1:khong dot xuat, 2: tiep dot xuat');
            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('lichtiepdans', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lichtiepdans');
    }
}
