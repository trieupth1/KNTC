<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatethamquyensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thamquyens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ten')->comment('ten tham quyen');
            $table->softDeletes();
            // Add some more columns

            $table->timestamps();
            $table->unique('ten');
        });

        $this->updateTimestampDefaultValue('thamquyens', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thamquyens');
    }
}
