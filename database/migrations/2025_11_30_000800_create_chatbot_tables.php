<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_sessions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('status', 20)->default('open');
            $table->string('locale', 8)->nullable();
            $table->text('needs')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('last_message_at')->nullable();
            $table->timestamps();
        });

        Schema::create('chat_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('chat_session_id');
            $table->string('sender', 20);
            $table->text('message');
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->foreign('chat_session_id')
                ->references('id')
                ->on('chat_sessions')
                ->cascadeOnDelete();

            $table->index('chat_session_id');
            $table->index('sender');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
        Schema::dropIfExists('chat_sessions');
    }
};
