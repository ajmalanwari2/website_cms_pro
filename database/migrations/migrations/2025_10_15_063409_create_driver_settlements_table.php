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
        Schema::create('driver_settlements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_payroll_id')->constrained()->cascadeOnDelete();
            $table->foreignId('load_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type')->comment('earning|deduction');
            $table->decimal('amount', 12, 2);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_settlements');
    }
};
