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
        Schema::create('classification_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('classification_id');
            $table->unsignedBigInteger('item_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');

            // Unique constraint to prevent duplicate entries
            $table->unique(['classification_id', 'item_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classification_item');
    }
};
