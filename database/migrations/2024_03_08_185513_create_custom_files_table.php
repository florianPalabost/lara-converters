<?php

declare(strict_types=1);

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
        Schema::create('custom_files', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');
            $table->string('path');
            $table->string('mime_type')->nullable();
            $table->string('extension')->nullable();
            $table->unsignedInteger('size')->default(0);
            $table->uuid('added_by')->nullable();

            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_files');
    }
};
