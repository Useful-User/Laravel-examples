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
        Schema::create('quote_sources', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('key', 100)->nullable();
            $table->text('url')->nullable();
            $table->string('resource')->nullable();
            $table->integer('priority')->nullable();
            $table->boolean('availability')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_sources');
    }
};
