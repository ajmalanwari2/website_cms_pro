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
        Schema::create('dispatch_driver', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dispatch_id')->nullable();
            $table->foreign('dispatch_id')->references('id')->on('dispatches');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->enum('accept_action', ['accept', 'decline'])->nullable();
            $table->enum('approve_action', ['accept', 'decline'])->nullable();
            $table->enum('type', ['percentage', 'load', 'per_mile']);
            $table->double('rate', 8,2)->nullable();
            $table->double('top_load', 8,2)->nullable();
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
        Schema::dropIfExists('dispatch_driver');
    }
};
