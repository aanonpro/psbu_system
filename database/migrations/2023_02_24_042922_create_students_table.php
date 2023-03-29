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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('stu_id')->nullable();
            $table->string('stu_name')->nullable();
            $table->string('stu_name_latin')->nullable();
            $table->string('stu_gender')->nullable();
            $table->date('stu_dob')->nullable();
            $table->text('stu_address')->nullable();
            $table->string('stu_phone')->unique();
            $table->string('stu_email')->nullable();
            $table->integer('degrees_id')->nullable();
            $table->integer('shift_id')->nullable();
            $table->integer('batch_id')->nullable();
            $table->string('status',1)->default('1');
            $table->string('trash',1)->default('0');
            $table->integer('created_by')->default('0');
            $table->integer('updated_by')->default('0');
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
        Schema::dropIfExists('students');
    }
};
