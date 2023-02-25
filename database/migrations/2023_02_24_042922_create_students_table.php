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
            $table->string('stu_id');
            $table->string('stu_name');
            $table->string('stu_name_latin');
            $table->string('stu_gender');
            $table->date('stu_dob');
            $table->text('stu_address');
            $table->string('stu_phone')->unique();
            $table->string('stu_email')->nullable();
            $table->integer('degrees_id');
            $table->integer('shift_id');
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
