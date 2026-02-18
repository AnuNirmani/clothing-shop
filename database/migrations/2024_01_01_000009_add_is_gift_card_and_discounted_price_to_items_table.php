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
            if (!Schema::hasColumn('items', 'is_gift_card')) {
                $table->boolean('is_gift_card')->default(false)->after('size_id');
            }
            if (!Schema::hasColumn('items', 'discounted_price')) {
                $table->decimal('discounted_price', 10, 2)->nullable()->after('is_gift_card');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['is_gift_card', 'discounted_price']);
        });
    }
};
