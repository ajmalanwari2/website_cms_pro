<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('village', function (Blueprint $table) {
            $table->id();
            $table->string('name_fa')->nullable();
            $table->string('name_pa')->nullable();
            $table->string('name_en')->nullable();
            $table->unsignedBigInteger('province_id')->nullable()->default(null);
            $table->foreign('province_id')->references('id')->on('province');
            $table->unsignedBigInteger('district_id')->nullable()->default(null);
            $table->foreign('district_id')->references('id')->on('district');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('village');
    }
}
