<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherCredential extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "email",
        "phone",
        "ref_name",
        "ref_email",
        "ref_phone",
        "ref_relationship",
        "ref_organisation",
        "ref_position",
        "verified",
        "right_to_work",
        "right_to_work_isverified",
        "dbs_certificate",
        "dbs_certificate_isverified",
        "educational_qualification",
        "educational_qualification_isverified",
        "qts",
        "qts_isverified",
        "passport_id_or_driver_license",
        "passport_id_or_driver_license_isverified",
        "passport_photo",
        "passport_photo_isverified",
        "proof_of_address",
        "proof_of_address_isverified",
        "national_insurance_number",
        "national_insurance_number_isverified",
        "permit_or_id",
        "permit_or_id_isverified",
        "signature"
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "subjects" => "array",
    ];
}
