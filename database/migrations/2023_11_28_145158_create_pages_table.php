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
        Schema::connection('website')->create('pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->string('name')->nullable();
            $table->string('slug')->unique();
            $table->integer('sort')->default(0);
            $table->longText('gjs_data')->nullable();
            $table->enum('status', config('app.statusParams'))->default('draft');
            foreach (config('app.statusParams') as $status) {
                $table->unsignedBigInteger($status.'_by')->nullable();
            }
            $table->enum('header_style', ['white','transparent'])->default('white');

            $table->text('meta_description')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
