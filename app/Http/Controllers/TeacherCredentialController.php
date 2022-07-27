<?php

namespace App\Http\Controllers;

use App\Events\TeacherVerified;
use App\Models\TeacherCredential;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherCredentialController extends Controller
{
    /**
     * Get all Teacher Credentials.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function showCredentials($id)
    {
        if(Auth::user()->role === "teacher") {
            $email = Auth::user()->email;
            
        } else {
            $user = User::findOrFail($id);
            $email = $user->email;
        }
        
        $credentials = TeacherCredential::where('email', $email)->first();
        if($credentials) {
            return response()->json($credentials);
        }
        
    }
    /**
     * Check and Verify Teacher.
     * 
     * @return bool
     */
    public function isverified($teacher)
    {               
        $teacher_credential = TeacherCredential::where('email', $teacher->email)->first();

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
        ) 
        {
            $teacher_credential->verified = 1;

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
        $user = User::findOrFail($id);
        if($user->role !== "teacher") {
            return response()->json([
                'message' => 'Can only verify a Teacher'
            ]);
        }

        $teacher_credential = TeacherCredential::where('email', $user->email)->first();
        $teacher_credential->right_to_work_isverified = 1;

        if($teacher_credential->save()) {
            if($this->isverified($user)) {
                TeacherVerified::dispatch($user);
            }
            return response()->json($teacher_credential);
        }

        return response()->json([
            'message' => 'Error saving Teacher Credentials'
        ]);
    }

     /**
     * Verify DBS Certificate.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function dbs_certificate($id)
    {               
        $user = User::findOrFail($id);
        if($user->role !== "teacher") {
            return response()->json([
                'message' => 'Can only verify a Teacher'
            ]);
        }

        $teacher_credential = TeacherCredential::where('email', $user->email)->first();
        $teacher_credential->dbs_certificate_isverified = 1;

        if($teacher_credential->save()) {
            if($this->isverified($user)) {
                TeacherVerified::dispatch($user);
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
        $user = User::findOrFail($id);
        if($user->role !== "teacher") {
            return response()->json([
                'message' => 'Can only verify a Teacher'
            ]);
        }

        $teacher_credential = TeacherCredential::where('email', $user->email)->first();
        $teacher_credential->educational_qualification_isverified = 1;

        if($teacher_credential->save()) {
            if($this->isverified($user)) {
                TeacherVerified::dispatch($user);
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
        $user = User::findOrFail($id);
        if($user->role !== "teacher") {
            return response()->json([
                'message' => 'Can only verify a Teacher'
            ]);
        }

        $teacher_credential = TeacherCredential::where('email', $user->email)->first();
        $teacher_credential->qts_isverified = 1;

        if($teacher_credential->save()) {
            if($this->isverified($user)) {
                TeacherVerified::dispatch($user);
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
        $user = User::findOrFail($id);
        if($user->role !== "teacher") {
            return response()->json([
                'message' => 'Can only verify a Teacher'
            ]);
        }

        $teacher_credential = TeacherCredential::where('email', $user->email)->first();
        $teacher_credential->passport_id_or_driver_license_isverified = 1;

        if($teacher_credential->save()) {
            if($this->isverified($user)) {
                TeacherVerified::dispatch($user);
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
        $user = User::findOrFail($id);
        if($user->role !== "teacher") {
            return response()->json([
                'message' => 'Can only verify a Teacher'
            ]);
        }

        $teacher_credential = TeacherCredential::where('email', $user->email)->first();
        $teacher_credential->passport_photo_isverified = 1;

        if($teacher_credential->save()) {
            if($this->isverified($user)) {
                TeacherVerified::dispatch($user);
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
        $user = User::findOrFail($id);
        if($user->role !== "teacher") {
            return response()->json([
                'message' => 'Can only verify a Teacher'
            ]);
        }

        $teacher_credential = TeacherCredential::where('email', $user->email)->first();
        $teacher_credential->proof_of_address_isverified = 1;

        if($teacher_credential->save()) {
            if($this->isverified($user)) {
                TeacherVerified::dispatch($user);
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
        $user = User::findOrFail($id);
        if($user->role !== "teacher") {
            return response()->json([
                'message' => 'Can only verify a Teacher'
            ]);
        }

        $teacher_credential = TeacherCredential::where('email', $user->email)->first();
        $teacher_credential->national_insurance_number_isverified = 1;

        if($teacher_credential->save()) {
            if($this->isverified($user)) {
                TeacherVerified::dispatch($user);
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
        $user = User::findOrFail($id);
        if($user->role !== "teacher") {
            return response()->json([
                'message' => 'Can only verify a Teacher'
            ]);
        }

        $teacher_credential = TeacherCredential::where('email', $user->email)->first();
        $teacher_credential->permit_or_id_isverified = 1;

        if($teacher_credential->save()) {
            if($this->isverified($user)) {
                TeacherVerified::dispatch($user);
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
        $teacher_credential = TeacherCredential::where('email', $teacher->email)->first();
       
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
            $teacher_credential->verified = 0;

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
        $user = User::findOrFail($id);
        if($user->role !== "teacher") {
            return response()->json([
                'message' => 'Can only verify a Teacher'
            ]);
        }

        $was_verified = $this->isverified($user);

        $teacher_credential = TeacherCredential::where('email', $user->email)->first();
        $teacher_credential->right_to_work_isverified = 0;

        if($teacher_credential->save()) {
            if($was_verified) {
                $this->unverify($user);
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
        $user = User::findOrFail($id);
        if($user->role !== "teacher") {
            return response()->json([
                'message' => 'Can only verify a Teacher'
            ]);
        }

        $was_verified = $this->isverified($user);

        $teacher_credential = TeacherCredential::where('email', $user->email)->first();
        $teacher_credential->dbs_certificate_isverified = 0;

        if($teacher_credential->save()) {
            if($was_verified) {
                $this->unverify($user);
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
        $user = User::findOrFail($id);
        if($user->role !== "teacher") {
            return response()->json([
                'message' => 'Can only verify a Teacher'
            ]);
        }

        $was_verified = $this->isverified($user);

        $teacher_credential = TeacherCredential::where('email', $user->email)->first();
        $teacher_credential->educational_qualification_isverified = 0;

        if($teacher_credential->save()) {
            if($was_verified) {
                $this->unverify($user);
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
        $user = User::findOrFail($id);
        if($user->role !== "teacher") {
            return response()->json([
                'message' => 'Can only verify a Teacher'
            ]);
        }

        $was_verified = $this->isverified($user);

        $teacher_credential = TeacherCredential::where('email', $user->email)->first();
        $teacher_credential->qts_isverified = 0;

        if($teacher_credential->save()) {
            if($was_verified) {
                $this->unverify($user);
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
        $user = User::findOrFail($id);
        if($user->role !== "teacher") {
            return response()->json([
                'message' => 'Can only verify a Teacher'
            ]);
        }

        $was_verified = $this->isverified($user);

        $teacher_credential = TeacherCredential::where('email', $user->email)->first();
        $teacher_credential->passport_id_or_driver_license_isverified = 0;

        if($teacher_credential->save()) {
            if($was_verified) {
                $this->unverify($user);
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
        $user = User::findOrFail($id);
        if($user->role !== "teacher") {
            return response()->json([
                'message' => 'Can only verify a Teacher'
            ]);
        }

        $was_verified = $this->isverified($user);

        $teacher_credential = TeacherCredential::where('email', $user->email)->first();
        $teacher_credential->passport_photo_isverified = 0;

        if($teacher_credential->save()) {
            if($was_verified) {
                $this->unverify($user);
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
        $user = User::findOrFail($id);
        if($user->role !== "teacher") {
            return response()->json([
                'message' => 'Can only verify a Teacher'
            ]);
        }

        $was_verified = $this->isverified($user);

        $teacher_credential = TeacherCredential::where('email', $user->email)->first();
        $teacher_credential->proof_of_address_isverified = 0;

        if($teacher_credential->save()) {
            if($was_verified) {
                $this->unverify($user);
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
        $user = User::findOrFail($id);
        if($user->role !== "teacher") {
            return response()->json([
                'message' => 'Can only verify a Teacher'
            ]);
        }

        $was_verified = $this->isverified($user);

        $teacher_credential = TeacherCredential::where('email', $user->email)->first();
        $teacher_credential->national_insurance_number_isverified = 0;

        if($teacher_credential->save()) {
            if($was_verified) {
                $this->unverify($user);
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
        $user = User::findOrFail($id);
        if($user->role !== "teacher") {
            return response()->json([
                'message' => 'Can only verify a Teacher'
            ]);
        }

        $was_verified = $this->isverified($user);

        $teacher_credential = TeacherCredential::where('email', $user->email)->first();
        $teacher_credential->permit_or_id_isverified = 0;

        if($teacher_credential->save()) {
            if($was_verified) {
                $this->unverify($user);
            }
            return response()->json($teacher_credential);
        }
    }
}
