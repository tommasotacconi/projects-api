<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn('projects', 'arguments')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->dropColumn('arguments');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Intentionally irreversible: 'arguments' data has been migrated to project_translations as 'purpose' and should not be restored on this table.
    }
};