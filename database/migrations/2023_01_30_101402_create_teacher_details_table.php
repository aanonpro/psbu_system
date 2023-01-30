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
        Schema::create('teacher_details', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->integer('position_id')->nullable();
            $table->integer('teacher_code')->nullable();
            $table->string('sex')->nullable();
            $table->date('dob')->nullable();
            $table->string('nationality')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->date('expired_date')->nullable();
            $table->string('noted')->nullable();
            $table->string('photo')->nullable();
            $table->string('status',1)->default(1);
            $table->string('trash',1)->default(0);
            $table->string('password')->nullable();
            $table->integer('created_by');
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
        Schema::dropIfExists('teacher_details');
    }
};
