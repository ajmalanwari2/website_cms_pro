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
        Schema::create('loads', function (Blueprint $table) {
            $table->id();
            $table->string('load_number')->nullable();
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('origin');
            $table->foreign('origin')->references('id')->on('locations')->onDelete('cascade');
            $table->unsignedBigInteger('destination');
            $table->foreign('destination')->references('id')->on('locations')->onDelete('cascade');
            $table->double('weight', 8, 2); // lbs
            $table->unsignedBigInteger('weight_unit_id');
            $table->foreign('weight_unit_id')->references('id')->on('weight_unit')->onDelete('cascade');
            $table->double('rate', 8, 2); // lbs
            $table->enum('cargo_type', ['dry', 'refrigerated', 'liquid'])->nullable();
            $table->dateTime('pickup_time');
            $table->dateTime('delivery_time')->nullable();
            $table->enum('status', ['pending', 'dispatched', 'in_transit', 'delivered'])->default('pending');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('loads');
    }
};
