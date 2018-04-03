<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreatedanhsachtiepdansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danhsachtiepdans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('so_thu_ly');
            $table->dateTime('ngay_tiep');
            $table->integer('lan_tiep');
            $table->integer('chu_the')->comment('1:ca nhan, 2: tap the');
            $table->string('doi_tuong');
            $table->longText('noi_dung_cong_dan_tb')->comment('noi dung cong dan trinh bay');
            $table->longText('co_quan_da_gq')->comment('co quan da giai quyet');
            $table->longText('nd_da_gq')->comment('noi dung da giai quyet');
            $table->longText('vuong_mac_de_nghi')->comment('vuong mac vaf de nghi giai quyet');
            $table->longText('de_xuat_xu_ly')->comment('de xuat xu ly cua can bo tiep dan');
            $table->longText('ket_luan')->commnet('ket luan cua chu tri tiep dan');
            $table->unsignedBigInteger('linhvuc_id');
            $table->unsignedBigInteger('chutri_id');
            $table->unsignedBigInteger('nguoithamgia_id');

            // Add some more columns

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('danhsachtiepdans', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('danhsachtiepdans');
    }
}
