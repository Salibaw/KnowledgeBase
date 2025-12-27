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
        Schema::create('solutions', function (Blueprint $table) {
            $table->id('solution_id'); 
            $table->foreignId('ticket_id')->constrained('tickets', 'ticket_id');
            $table->foreignId('kb_id')->nullable()->constrained('knowledge_base', 'kb_id'); 
            $table->text('solution'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solutions');
    }
};
