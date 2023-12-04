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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();            
            $table->string('title');
            $table->longText('body');
            $table->string('url')->nullable();
            $table->string('image')->nullable();
            $table->string('author');
            $table->dateTime('publish_date');
            $table->unsignedBigInteger('source_id')->nullable();
            $table->foreign('source_id')->references('id')->on('sources')->onDelete('set null');
            $table->string('category')->index();
            $table->string('web_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
