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
        Schema::connection('website')->create('request_hirings', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->unsignedBigInteger('position_id')->nullable();
            $table->unsignedBigInteger('level_id')->nullable();
            $table->string('full_name');
            $table->enum('applied', ['yes','no','maybe'])->default('no');
            $table->string('phone');
            $table->enum('gender', ['male','female'])->default('male');
            $table->date('birth_date')->nullable();
            $table->enum('live_in_cairo', ['yes','no'])->default('yes');
            $table->string('address')->nullable();
            $table->string('personal_photo')->nullable();
            $table->string('college')->nullable();
            $table->string('degree')->nullable();
            $table->enum('work_style', ['office','remotely','hybrid'])->default('office');
            $table->enum('employment', ['full_time','part_time'])->default('full_time');
            $table->enum('experience', ['1','2','3','+4'])->default('1');
            $table->string('cv')->nullable();
            $table->date('start_date')->nullable();
            $table->enum('employed', ['yes','no'])->default('no');
            $table->string('company_name')->nullable();
            $table->string('currant_position')->nullable();
            $table->string('currant_salary')->nullable();
            $table->string('expected_salary')->nullable();
            $table->string('projects_links')->nullable();
            $table->string('skillset')->nullable();
            $table->string('experience_essay')->nullable();
            $table->enum('have_laptop', ['yes','no'])->default('yes');
            $table->string('laptop_brand')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            // $table->foreign('deleted_by')->references('id')->on('mysql.users')->onDelete('cascade');
            $table->timestamps();
        });
        // DB::connection('website')->statement('ALTER TABLE request_hirings ADD CONSTRAINT request_hirings_deleted_by_foreign FOREIGN KEY (deleted_by) REFERENCES users(id) ON DELETE CASCADE');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // DB::connection('website')->statement('ALTER TABLE request_hirings DROP FOREIGN KEY request_hirings_deleted_by_foreign');

        Schema::dropIfExists('request_hirings');
    }
};
