<?php

namespace App\Http\Controllers;

use App\Events\TeacherVerified;
use App\Models\TeacherCredential;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherCredentialController extends Controller
{
    /**
     * Verify Teacher.
     * 
     * @return bool
     */
    public function showCredentials($email)
    {
        $teacher_credential = TeacherCredential::where('email', $email);

        if($teacher_credential) {
            return response()->json($teacher_credential); 
        }

        return response()->json([
            'error' => 'This user is not  teacher'
        ]);

    }
    /**
     * Verify Teacher.
     * 
     * @return bool
     */
    public function isverified($teacher)
    {               
        $teacher_credential = TeacherCredential::where('email', $teacher->email);

        if(
            $teacher_credential->right_to_work_isverified &&
            $teacher_credential->dbs_certificate_isverified &&
            $teacher_credential->educational_qualification_isverified &&
            $teacher_credential->qts_isverified &&
            $teacher_credential->passport_id_or_driver_license_isverified &&
            $teacher_credential->passport_photo_isverified &&
            $teacher_credential->proof_of_address_isverified &&
            $teacher_credential->national_insurance_number_isverified &&
            $teacher_credential->permit_or_id_isverified
        ) {
            $teacher_credential->verified = true;

            if($teacher_credential->save()) {
                return true;
            }
        }

        return false;  
    }

    /**
     * Verify Right to Work.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function right_to_work($id)
    {               
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $teacher_credential = TeacherCredential::where('email', $teacher->email);
        $teacher_credential->right_to_work_isverified = true;

        if($teacher_credential->save()) {
            if($this->isverified($teacher)) {
                TeacherVerified::dispatch($teacher);
            }
            return response()->json($teacher_credential);
        }
    }

     /**
     * Verify DBS Certificate.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function dbs_certificate($id)
    {               
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $teacher_credential = TeacherCredential::where('email', $teacher->email);
        $teacher_credential->dbs_certificate_isverified = true;

        if($teacher_credential->save()) {
            if($this->isverified($teacher)) {
                TeacherVerified::dispatch($teacher);
            }
            return response()->json($teacher_credential);
        }
    }


     /**
     * Verify Educational Qualification.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function educational_qualification($id)
    {               
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $teacher_credential = TeacherCredential::where('email', $teacher->email);
        $teacher_credential->educational_qualification_isverified = true;

        if($teacher_credential->save()) {
            if($this->isverified($teacher)) {
                TeacherVerified::dispatch($teacher);
            }
            return response()->json($teacher_credential);
        }
    }


    /**
     * Verify QTS.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function qts($id)
    {               
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $teacher_credential = TeacherCredential::where('email', $teacher->email);
        $teacher_credential->qts_isverified = true;

        if($teacher_credential->save()) {
            if($this->isverified($teacher)) {
                TeacherVerified::dispatch($teacher);
            }
            return response()->json($teacher_credential);
        }
    }

     /**
     * Verify Passport ID or Driver's License.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function passport_id_or_driver_license($id)
    {               
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $teacher_credential = TeacherCredential::where('email', $teacher->email);
        $teacher_credential->passport_id_or_driver_license_isverified = true;

        if($teacher_credential->save()) {
            if($this->isverified($teacher)) {
                TeacherVerified::dispatch($teacher);
            }
            return response()->json($teacher_credential);
        }
    }


    /**
     * Verify Passport Photo.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function passport_photo($id)
    {               
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $teacher_credential = TeacherCredential::where('email', $teacher->email);
        $teacher_credential->passport_photo_isverified = true;

        if($teacher_credential->save()) {
            if($this->isverified($teacher)) {
                TeacherVerified::dispatch($teacher);
            }
            return response()->json($teacher_credential);
        }
    }

    /**
     * Verify Proof of Address.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function proof_of_address($id)
    {               
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $teacher_credential = TeacherCredential::where('email', $teacher->email);
        $teacher_credential->proof_of_address_isverified = true;

        if($teacher_credential->save()) {
            if($this->isverified($teacher)) {
                TeacherVerified::dispatch($teacher);
            }
            return response()->json($teacher_credential);
        }
    }

    /**
     * Verify National Insurance Number.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function national_insurance_number($id)
    {               
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $teacher_credential = TeacherCredential::where('email', $teacher->email);
        $teacher_credential->national_insurance_number_isverified = true;

        if($teacher_credential->save()) {
            if($this->isverified($teacher)) {
                TeacherVerified::dispatch($teacher);
            }
            return response()->json($teacher_credential);
        }
    }

    /**
     * Verify Permit.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function permit_or_id($id)
    {               
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $teacher_credential = TeacherCredential::where('email', $teacher->email);
        $teacher_credential->permit_or_id_isverified = true;

        if($teacher_credential->save()) {
            if($this->isverified($teacher)) {
                TeacherVerified::dispatch($teacher);
            }
            return response()->json($teacher_credential);
        }
    }



    /**
     * Unverify Teacher.
     * 
     * @return bool
     */
    public function unverify($teacher)
    {
        $teacher_credential = TeacherCredential::where('email', $teacher->email);
       
        if(
            $teacher_credential->right_to_work_isverified ||
            $teacher_credential->dbs_certificate_isverified ||
            $teacher_credential->educational_qualification_isverified ||
            $teacher_credential->qts_isverified ||
            $teacher_credential->passport_id_or_driver_license_isverified ||
            $teacher_credential->passport_photo_isverified ||
            $teacher_credential->proof_of_address_isverified ||
            $teacher_credential->national_insurance_number_isverified ||
            $teacher_credential->permit_or_id_isverified
        ) {
            $teacher_credential->verified = false;

            if($teacher_credential->save()) {
                TeacherVerified::dispatch($teacher);
                return response()->json($teacher_credential);
            }
        }
    }

    /**
     * Unverify Right to Work.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function not_right_to_work($id)
    {               
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $was_verified = $this->isverified($teacher);

            if($was_verified) {
                $this->unveirfy($teacher);
            }

        $teacher_credential = TeacherCredential::where('email', $teacher->email);
        $teacher_credential->right_to_work_isverified = false;

        if($teacher_credential->save()) {
            if($was_verified) {
                $this->unverify($teacher);
            }
            return response()->json($teacher_credential);
        }
    }

     /**
     * Unverify DBS Certificate.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function not_dbs_certificate($id)
    {               
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $was_verified = $this->isverified($teacher);

        $teacher_credential = TeacherCredential::where('email', $teacher->email);
        $teacher_credential->dbs_certificate_isverified = false;

        if($teacher_credential->save()) {
            if($was_verified) {
                $this->unverify($teacher);
            }
            return response()->json($teacher_credential);
        }
    }


     /**
     * Unverify Educational Qualification.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function not_educational_qualification($id)
    {               
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $was_verified = $this->isverified($teacher);

        $teacher_credential = TeacherCredential::where('email', $teacher->email);
        $teacher_credential->educational_qualification_isverified = false;

        if($teacher_credential->save()) {
            if($was_verified) {
                $this->unverify($teacher);
            }
            return response()->json($teacher_credential);
        }
    }


    /**
     * Unverify QTS.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function not_qts($id)
    {               
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $was_verified = $this->isverified($teacher);

        $teacher_credential = TeacherCredential::where('email', $teacher->email);
        $teacher_credential->qts_isverified = false;

        if($teacher_credential->save()) {
            if($was_verified) {
                $this->unverify($teacher);
            }
            return response()->json($teacher_credential);
        }
    }

     /**
     * Unverify Passport ID or Driver's License.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function not_passport_id_or_driver_license($id)
    {               
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $was_verified = $this->isverified($teacher);

        $teacher_credential = TeacherCredential::where('email', $teacher->email);
        $teacher_credential->passport_id_or_driver_license_isverified = false;

        if($teacher_credential->save()) {
            if($was_verified) {
                $this->unverify($teacher);
            }
            return response()->json($teacher_credential);
        }
    }


    /**
     * Unverify Passport Photo.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function not_passport_photo($id)
    {               
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $was_verified = $this->isverified($teacher);

        $teacher_credential = TeacherCredential::where('email', $teacher->email);
        $teacher_credential->passport_photo_isverified = false;

        if($teacher_credential->save()) {
            if($was_verified) {
                $this->unverify($teacher);
            }
            return response()->json($teacher_credential);
        }
    }

    /**
     * Unverify Proof of Address.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function not_proof_of_address($id)
    {               
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $was_verified = $this->isverified($teacher);

        $teacher_credential = TeacherCredential::where('email', $teacher->email);
        $teacher_credential->proof_of_address_isverified = false;

        if($teacher_credential->save()) {
            if($was_verified) {
                $this->unverify($teacher);
            }
            return response()->json($teacher_credential);
        }
    }

    /**
     * Unverify National Insurance Number.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function not_national_insurance_number($id)
    {               
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $was_verified = $this->isverified($teacher);

        $teacher_credential = TeacherCredential::where('email', $teacher->email);
        $teacher_credential->national_insurance_number_isverified = false;

        if($teacher_credential->save()) {
            if($was_verified) {
                $this->unverify($teacher);
            }
            return response()->json($teacher_credential);
        }
    }

    /**
     * Unverify Permit ID.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function not_permit_or_id($id)
    {               
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $was_verified = $this->isverified($teacher);

        $teacher_credential = TeacherCredential::where('email', $teacher->email);
        $teacher_credential->permit_or_id_isverified = false;

        if($teacher_credential->save()) {
            if($was_verified) {
                $this->unverify($teacher);
            }
            return response()->json($teacher_credential);
        }
    }
}
