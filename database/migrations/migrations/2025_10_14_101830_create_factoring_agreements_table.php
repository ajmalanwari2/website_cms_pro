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
        Schema::create('factoring_agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('factoring_company_id')->constrained()->cascadeOnDelete();
            $table->string('agreement_number')->unique();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->decimal('advance_rate', 5, 2)->default(90);
            $table->decimal('fee_rate', 5, 2)->default(2);
            $table->text('terms')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factoring_agreements');
    }
};
