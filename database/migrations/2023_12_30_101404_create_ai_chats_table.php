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
        // chat_id,user_id,model,object,prompt_tokens,completion_tokens,total_tokens,system_fingerprint
        // index,role,content,logprobs,finish_reason
        Schema::create('ai_chats', function (Blueprint $table) {
            $table->id();
            $table->string('chat_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('model')->nullable();
            $table->string('object')->nullable();
            $table->integer('prompt_tokens')->nullable();
            $table->integer('completion_tokens')->nullable();
            $table->integer('total_tokens')->nullable();
            $table->string('system_fingerprint')->nullable();
            $table->integer('index')->nullable();
            $table->string('role')->nullable();
            $table->longText('content')->nullable();
            $table->string('logprobs')->nullable();
            $table->string('finish_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_chats');
    }
};
