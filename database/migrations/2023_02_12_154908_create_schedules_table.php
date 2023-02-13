<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id')->nullable();
            $table->integer('major_id')->nullable();
            $table->integer('academic_id')->nullable();
            $table->integer('semester_id')->nullable();
            $table->integer('shift_id')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->integer('session_id')->nullable();
            $table->integer('room_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_kh')->nullable();
            $table->integer('batchelor')->nullable();
            $table->date('academic_year')->nullable();
            $table->string('status',1)->default(1);
            $table->string('trash',1)->default(0);
            $table->integer('created_by')->default(1);
            $table->integer('updated_by')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
