<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->string('truck_number');
            $table->enum('make', ['freightliner', 'kenworth', 'peterbilt', 'volvo', 'international', 'mack', 'western_star', 'isuzu', 'hino', 'ford', 'gmc', 'mercedes_benz', 'scania', 'man', 'daf']);
            $table->string('model');
            $table->string('vin');
            $table->year('year');
            $table->date('issue_date')->nullable();
            $table->date('effective_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->string('plate_number');
            $table->unsignedBigInteger('trailer_id')->nullable();
            $table->foreign('trailer_id')->references('id')->on('trailers');
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
     */
    public function down(): void
    {
        Schema::dropIfExists('trucks');
    }
};
