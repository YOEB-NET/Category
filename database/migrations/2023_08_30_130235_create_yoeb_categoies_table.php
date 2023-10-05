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
        Schema::create('yoeb_categories', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->longText("description")->nullable();
            $table->string("icon")->nullable();
            $table->string("image")->nullable();
            $table->integer("top_category")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};

