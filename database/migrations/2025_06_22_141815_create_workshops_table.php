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
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->string('slug');
            $table->string('thumbnail');
            $table->string('bg_map');
            $table->string('venue_thumbnail');

            $table->text('about');
            $table->text('address');        
            
            $table->unsignedBigInteger('price');
            
            $table->boolean('is_open');        
            $table->boolean('has_started');
            
            $table->date('started_at');   // Kapan workshop dimulai
            
            $table->time('time_at');   // Waktu workshop dimulai
            
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('workshop_instructor_id')->constrained()->cascadeOnDelete();
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workshops');
    }
};
