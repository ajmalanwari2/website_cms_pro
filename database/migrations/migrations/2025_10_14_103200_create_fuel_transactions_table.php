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
        Schema::create('fuel_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fuel_card_id')->constrained()->cascadeOnDelete();
            $table->foreignId('truck_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('driver_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('load_id')->nullable()->constrained()->nullOnDelete();
            $table->date('transaction_date')->nullable();
            $table->string('location')->nullable();
            $table->decimal('liters', 10, 3)->nullable();
            $table->decimal('price_per_liter', 12, 4)->nullable();
            $table->decimal('amount', 12, 2);
            $table->string('reference')->nullable(); // provider tx id
            $table->boolean('reconciled')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_transactions');
    }
};
