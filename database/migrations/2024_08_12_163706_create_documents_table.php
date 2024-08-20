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
        Schema::create('documents', function (Blueprint $table) {
            $table->id('document_id');
            $table->string('name');
            $table->string('path');
            $table->date('date_created');
            $table->string('author');
            $table->datetime('last_update')->nullable();
            $table->integer('last_user')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('project_id');

            $table->foreign('project_id')->references('project_id')->on('projects')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
