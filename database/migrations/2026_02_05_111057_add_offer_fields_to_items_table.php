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
            $table->boolean('is_on_offer')->default(false)->after('gift_card_validity_months');
            $table->decimal('offer_percentage', 5, 2)->nullable()->after('is_on_offer')->comment('Discount percentage (0-100)');
            $table->date('offer_start_date')->nullable()->after('offer_percentage');
            $table->date('offer_end_date')->nullable()->after('offer_start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['is_on_offer', 'offer_percentage', 'offer_start_date', 'offer_end_date']);
        });
    }
};
