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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable();
            $table->string('name')->nullable();
            $table->string('khmer')->nullable();
            $table->string('floor')->nullable();
            $table->integer('chair')->nullable();
            $table->integer('table')->nullable();
            $table->string('property')->nullable();
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
        Schema::dropIfExists('rooms');
    }
};
