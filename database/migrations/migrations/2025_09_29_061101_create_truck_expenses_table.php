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
        Schema::create('truck_expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('truck_id')->nullable()->default(null);
            $table->foreign('truck_id')->references('id')->on('trucks');
            $table->enum('type', [
                'fuel',
                'toll',
                'maintenance',
                'repair',
                'tires',
                'oil_change',
                'insurance',
                'registration',
                'parking',
                'wash_cleaning',
                'tax'
            ])->nullable();
            $table->integer('amount');
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            $table->string('attachment')->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->default(null);
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->nullable()->default(null);
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
        Schema::dropIfExists('truck_expenses');
    }
};
