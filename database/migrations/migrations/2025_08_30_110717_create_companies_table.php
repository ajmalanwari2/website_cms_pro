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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_number')->unique();
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('dot_number')->unique(); // DOT number
            $table->string('mc_number')->unique();  // MC number
            $table->json('authorities')->nullable(); // e.g., {"operating": true, "hazmat": true, "broker": false}
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('ein')->nullable(); // or federal_tax_id
            $table->string('scac')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('companies');
    }
};
