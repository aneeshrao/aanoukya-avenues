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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category');
            $table->string('location')->nullable();
            $table->string('year_label', 20)->nullable();
            $table->string('cover_image');
            $table->json('gallery_images')->nullable();
            $table->string('project_area', 50)->nullable();
            $table->string('status_label', 50)->nullable();
            $table->text('summary');
            $table->longText('description');
            $table->unsignedInteger('display_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
