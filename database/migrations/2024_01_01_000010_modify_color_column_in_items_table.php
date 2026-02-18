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
            // Check if color column exists
            if (Schema::hasColumn('items', 'color')) {
                // Option 1: Make it nullable (if you want to keep it)
                $table->string('color')->nullable()->change();
                
                // Option 2: Drop it (if using many-to-many relationship)
                // Uncomment the line below if you want to drop the column instead
                // $table->dropColumn('color');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            if (Schema::hasColumn('items', 'color')) {
                $table->string('color')->nullable(false)->change();
            }
        });
    }
};
