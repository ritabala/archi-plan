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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('type');       // e.g., proposal_sent, portfolio_shared
            $table->string('title');      // short notification title
            $table->text('message')->nullable(); // detailed message
            $table->string('link')->nullable();  // link to related module (e.g., /proposals/123)
            $table->json('data')->nullable();    // extra metadata (proposal_id, client_id, etc.)
            
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
        Schema::dropIfExists('notifications');
    }
};
