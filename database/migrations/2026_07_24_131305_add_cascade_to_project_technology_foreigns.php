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
        Schema::table('project_technology', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['technology_id']);

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

            $table->foreign('technology_id')->references('id')->on('technologies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_technology', function (Blueprint $table) {
            // Intentionally left empty: once cascade is set, don't make rollback
            // revert to non-cascading behavior
        });
    }
};
