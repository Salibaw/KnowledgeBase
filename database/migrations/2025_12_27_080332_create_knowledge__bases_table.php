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
        Schema::create('knowledge_base', function (Blueprint $table) {
            $table->id('kb_id'); 
            $table->string('problem_title');
            $table->text('solution');
            $table->text('cleaned_text');
            $table->json('vector_weights')->nullable(); 
            $table->text('keyword');
            $table->boolean('is_verified')->default(false); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('knowledge__bases');
    }
};
