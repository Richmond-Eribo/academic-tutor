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
        Schema::create('teacher_credentials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();
	        $table->string('ref_name')->nullable();
            $table->string('ref_email')->nullable() ;
            $table->string('ref_phone')->nullable(); 
            $table->string('ref_relationship')->nullable();
            $table->string('ref_organisation')->nullable();
            $table->string('ref_position')->nullable();
            $table->boolean("verified")->default(false);
            $table->string('right_to_work')->nullable();
            $table->boolean("right_to_work_isverified")->default(false);
            $table->string('dbs_certificate')->nullable();
            $table->boolean("dbs_certificate_isverified")->default(false);
            $table->string('educational_qualification')->nullable();
            $table->boolean("educational_qualification_isverified")->default(false);
            $table->string('qts')->nullable();
            $table->boolean("qts_isverified")->default(false);
            $table->string('passport_id_or_driver_license')->nullable();
            $table->boolean("passport_id_or_driver_license_isverified")->default(false);
            $table->string('passport_photo')->nullable();
            $table->boolean("passport_photo_isverified")->default(false);
            $table->string('proof_of_address')->nullable();
            $table->boolean("proof_of_address_isverified")->default(false);
            $table->string('national_insurance_number')->nullable();
            $table->boolean("national_insurance_number_isverified")->default(false);
            $table->string('permit_or_id')->nullable();
            $table->boolean("permit_or_id_isverified")->default(false);
            $table->string('signature')->nullable();
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
        Schema::dropIfExists('teacher_credentials');
    }
};
