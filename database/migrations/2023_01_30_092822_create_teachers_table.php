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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->integer('position_id')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_kh')->nullable();
            $table->string('code')->nullable()->unique();
            $table->string('sex')->nullable();
            $table->date('dob')->nullable();
            $table->string('pob')->nullable();
            $table->string('nationality')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->date('expired_date')->nullable();
            $table->string('noted')->nullable();
            $table->string('image')->nullable();
            $table->string('status',1)->default(1);
            $table->string('trash',1)->default(0);
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
        Schema::dropIfExists('teachers');
    }
};
