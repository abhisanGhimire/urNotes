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
        Schema::table('notes', function (Blueprint $table) {
            $table->uuid('uuid');
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->dropColumn('uuid');
            $table->dropColumn('user_id');
            $table->dropColumn('title');
            $table->dropColumn('deleted_at');
        });
    }
};
