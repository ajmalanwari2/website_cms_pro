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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('id_number')->nullable()->unique();
            $table->enum('designation', ['super_admin', 'admin', 'manager', 'finance', 'dispatcher', 'staff'])->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('image')->nullable();
            $table->decimal('salary', 12, 2)->nullable();

            // وضعیت و سایر فیلدها
            $table->enum('status', ['active', 'inactive'])->default('active'); // active, inactive
            $table->unsignedBigInteger('account_user_id')->nullable();

            // ایجاد و بروزرسانی
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            // کلیدهای خارجی (اگر جداول مربوطه آماده هستند)
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
