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
        Schema::connection('website')->create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->string('input_type');
            $table->string('name');
            $table->string('placeholder')->nullable();
            $table->integer('length');
            $table->boolean('required')->default(false);
            $table->integer('file_size')->nullable();
            $table->text('files_type')->nullable();
            $table->boolean('multi_file')->default(false);
            $table->integer('file_num')->default(0);
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_fields');
    }
};
