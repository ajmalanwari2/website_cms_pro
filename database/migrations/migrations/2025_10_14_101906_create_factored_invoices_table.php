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
        Schema::create('factored_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->cascadeOnDelete();
            $table->foreignId('factoring_agreement_id')->constrained()->cascadeOnDelete();
            $table->decimal('invoice_total', 12, 2);
            $table->decimal('advance_amount', 12, 2)->nullable();
            $table->decimal('remaining_amount', 12, 2)->nullable();
            $table->decimal('fee_amount', 12, 2)->nullable();
            $table->enum('status', ['submitted', 'advanced', 'settled'])->default('submitted');
            $table->date('submitted_at')->nullable();
            $table->date('advanced_at')->nullable();
            $table->date('settled_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factored_invoices');
    }
};
