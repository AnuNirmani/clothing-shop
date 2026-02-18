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
            // Check if material column exists
            if (Schema::hasColumn('items', 'material')) {
                // Option 1: Make it nullable (if you want to keep it)
                $table->string('material')->nullable()->change();
                
                // Option 2: Drop it (recommended since you have material_id)
                // Uncomment the line below if you want to drop the column instead
                // $table->dropColumn('material');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            if (Schema::hasColumn('items', 'material')) {
                $table->string('material')->nullable(false)->change();
            }
        });
    }
};
