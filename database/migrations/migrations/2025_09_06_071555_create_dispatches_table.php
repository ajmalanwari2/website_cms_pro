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
        Schema::create('dispatches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('load_id')->nullable();
            $table->unsignedBigInteger('truck_id')->nullable();
            $table->unsignedBigInteger('trailer_id')->nullable();
            $table->dateTime('dispatched_at');
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();
            $table->foreign('load_id')->references('id')->on('loads')->onDelete('cascade');
            $table->foreign('truck_id')->references('id')->on('trucks')->onDelete('cascade');
            $table->foreign('trailer_id')->references('id')->on('trailers')->onDelete('cascade');
            $table->enum('status', ['dispatched', 'in_transit', 'delivered'])->default('dispatched');
            $table->enum('isPaired', ['yes', 'no'])->nullable();
            $table->string('pod')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatches');
    }
};
