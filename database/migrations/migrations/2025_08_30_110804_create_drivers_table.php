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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('cdl_number')->unique();
            $table->date('cdl_expiration');
            $table->enum('cdl_class', ['a', 'b', 'c']);
            $table->unsignedBigInteger('driver_user_id')->nullable();
            $table->foreign('driver_user_id')->references('id')->on('users');
            $table->enum('status', ['active', 'inactive'])->default('active'); // active, inactive
            $table->string('image')->nullable();
            $table->json('endorsements')->nullable(); // [‘T’, ‘H’, etc.]
            $table->date('date_of_birth')->nullable();
            $table->date('hire_date')->nullable();
            $table->date('termination_date')->nullable();
            $table->string('license_number')->nullable();
            $table->enum('license_state', ['OH', 'IA', 'CA', 'TX', 'NE'])->nullable();
            $table->string('medical_file_code')->nullable();
            $table->date('medical_file_issue_date')->nullable();
            $table->string('ssn')->nullable();
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
        Schema::dropIfExists('drivers');
    }
};
