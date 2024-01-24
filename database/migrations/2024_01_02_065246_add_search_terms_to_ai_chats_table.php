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
        Schema::table('ai_chats', function (Blueprint $table) {
            // add the search term
            $table->longText('search_term')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ai_chats', function (Blueprint $table) {
            // remove the column search_term
            $table->dropColumn('search_term');
        });
    }
};
