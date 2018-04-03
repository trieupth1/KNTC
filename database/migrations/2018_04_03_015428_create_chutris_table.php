<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatechutrisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chutris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('admin_user_id')->comment('id user');
            $table->string('chuc_vu');
            $table->softDeletes();

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('chutris', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chutris');
    }
}
