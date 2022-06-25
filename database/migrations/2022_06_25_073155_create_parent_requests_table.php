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
        Schema::create('parent_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->string('parent_name');
            $table->string('parent_email');
            $table->string('parent_phone');
            $table->integer('teacher_id');
            $table->string('teacher_name');
            $table->string('teacher_email');
            $table->string('teacher_phone');
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
        Schema::dropIfExists('parent_requests');
    }
};
