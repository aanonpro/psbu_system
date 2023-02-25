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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->integer('faculty_id')->index()->nullable();
            $table->integer('department_id')->index()->nullable();
            $table->integer('major_id')->index()->nullable();
            $table->integer('semester_id')->index()->nullable();
            $table->integer('batch_id')->index()->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_kh')->nullable();
            $table->integer('credit')->nullable();
            $table->string('shortcut')->nullable();
            $table->string('noted')->nullable();
            $table->string('status',1)->default(1);
            $table->string('trash',1)->default(0);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();

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
        Schema::dropIfExists('subjects');
    }
};
