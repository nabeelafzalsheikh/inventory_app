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
        Schema::create('admin_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('admins')->onDelete('cascade');
            $table->string('subject');
            $table->text('message');
            $table->timestamps();
        });
        
        Schema::create('admin_message_recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('message_id')->constrained('admin_messages')->onDelete('cascade');
            $table->foreignId('recipient_id')->constrained('admins')->onDelete('cascade');
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_messages');
    }
};
