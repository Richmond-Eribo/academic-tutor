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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->bigInteger('phone')->unique(); 
            $table->string('relationship');
            $table->string('organisation');
            $table->string('position');
            $table->string('profile');
            $table->string('subjects')->nullable(); 
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string("role");
            $table->boolean("verified")->default(0);
            $table->string('permit_or_id')->nullable();
            $table->string('signature')->nullable();
            $table->string('profile_picture')->nullable();   
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
