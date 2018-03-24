<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatedonviguidonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donviguidons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sokyhieu');
            $table->unsignedBigInteger('donvi_id');
            $table->date('ngaybanhanh');

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('donviguidons', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donviguidons');
    }
}
