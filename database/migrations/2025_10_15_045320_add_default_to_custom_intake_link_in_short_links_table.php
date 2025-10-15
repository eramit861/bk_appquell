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
        Schema::table('short_links', function (Blueprint $table) {
            // Make custom_intake_link nullable to fix the default value error
            $table->string('custom_intake_link')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('short_links', function (Blueprint $table) {
            // Revert the column back to not nullable (if needed)
            $table->string('custom_intake_link')->nullable(false)->change();
        });
    }
};
