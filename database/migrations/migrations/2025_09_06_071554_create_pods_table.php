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
        Schema::create('pods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('load_id');
            $table->foreign('load_id')->references('id')->on('loads')->onDelete('cascade');
            $table->string('signed_by');
            $table->dateTime('signed_at');
            $table->string('pod_file')->nullable(); // file path for uploaded POD doc
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pods');
    }
};
