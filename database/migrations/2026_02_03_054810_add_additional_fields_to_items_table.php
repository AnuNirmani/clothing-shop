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
        Schema::table('items', function (Blueprint $table) {
            $table->string('co_name')->nullable()->after('name');
            $table->text('description')->nullable()->after('co_name');
            $table->text('note')->nullable()->after('description');
            $table->enum('availability', ['in stock', 'out of stock'])->default('in stock')->after('stock_items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['co_name', 'description', 'note', 'availability']);
        });
    }
};
