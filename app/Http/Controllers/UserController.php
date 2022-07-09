<?php

namespace App\Http\Controllers;

use App\Events\UserSignedUp;
use App\Events\UserUpdated;
use App\Models\TeacherCredential;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Store User data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $user = new User();

        $request->whenFilled('name', function($input) {

        });

        $user->name = $request->input('name');
        $email = $request->input('email');
        $user->email = $email;
        $user->phone = $request->input('phone');
        $role = $request->input('role');
        $user->role = $role;
        $user->password = Hash::make($request->input('password'));
        $user->profile = $request->input('profile');
        $user->subjects = $request->input('subjects');

        if($request->hasFile('profile_picture')) {
            $profile_picture = $request->file('profile_picture');
            $profile_picture_fileName = $email.'/_profile_picture.'. $profile_picture->getClientOriginalExtension();
            $user->profile_picture = $profile_picture_fileName;
        }

        
        
        if($user->save()) {
            $request->file('profile_picture') ? $this->uploadFile($profile_picture_fileName, $profile_picture) : null;

            if($role === 'teacher') {
                $teacher_credential = new TeacherCredential();
    
                $teacher_credential->name = $request->input('name');
                $teacher_credential->email = $email;
                $teacher_credential->phone = $request->input('phone');   
                $teacher_credential->ref_name = $request->input('ref_name'); 
                $teacher_credential->ref_email = $request->input('ref_email');
                $teacher_credential->ref_phone = $request->input('ref_phone'); 
                $teacher_credential->ref_relationship = $request->input('ref_relationship');
                $teacher_credential->ref_organisation = $request->input('ref_organisation');
                $teacher_credential->ref_position = $request->input('ref_position');
                
                if($request->hasFile('right_to_work')) {
                    $right_to_work = $request->file('right_to_work');
                    $right_to_work_fileName = $email.'/_right_to_work.'. $right_to_work->getClientOriginalExtension();
                    $teacher_credential->right_to_work = $right_to_work_fileName;
                    $this->uploadFile($right_to_work_fileName, $right_to_work);
                }

                if($request->hasFile('dbs_certificate')) {
                    $dbs_certificate = $request->file('dbs_certificate');
                    $dbs_certificate_fileName = $email.'/_dbs_certificate.'. $dbs_certificate->getClientOriginalExtension();
                    $teacher_credential->dbs_certificate = $dbs_certificate_fileName;
                    $this->uploadFile($dbs_certificate_fileName, $dbs_certificate);
                }

                if($request->hasFile('educational_qualification')) {
                    $educational_qualification = $request->file('educational_qualification');
                    $educational_qualification_fileName = $email.'/_educational_qualification.'. $educational_qualification->getClientOriginalExtension();
                    $teacher_credential->educational_qualification = $educational_qualification_fileName;
                    $this->uploadFile($educational_qualification_fileName, $educational_qualification);
                }

                if($request->hasFile('qts')) {
                    $qts = $request->file('qts');
                    $qts_fileName = $email.'/_qts.'. $qts->getClientOriginalExtension();
                    $teacher_credential->qts = $qts_fileName;
                    $this->uploadFile($qts_fileName, $qts);
                }

                if($request->hasFile('passport_id_or_driver_license')) {
                    $passport_id_or_driver_license = $request->file('passport_id_or_driver_license');
                    $passport_id_or_driver_license_fileName = $email.'/_passport_id_or_driver_license.'. $passport_id_or_driver_license->getClientOriginalExtension();
                    $teacher_credential->passport_id_or_driver_license = $passport_id_or_driver_license_fileName;
                    $this->uploadFile($passport_id_or_driver_license_fileName, $passport_id_or_driver_license);
                }

                if($request->hasFile('passport_photo')) {
                    $passport_photo = $request->file('passport_photo');
                    $passport_photo_fileName = $email.'/_passport_photo.'. $passport_photo->getClientOriginalExtension();
                    $teacher_credential->passport_photo = $passport_photo_fileName;
                    $this->uploadFile($passport_photo_fileName, $passport_photo);
                }

                if($request->hasFile('profile_picture')) {
                    $proof_of_address = $request->file('proof_of_address');
                    $proof_of_address_fileName = $email.'/_proof_of_address.'. $proof_of_address->getClientOriginalExtension();
                    $teacher_credential->proof_of_address = $proof_of_address_fileName;
                    $this->uploadFile($proof_of_address_fileName, $proof_of_address);
                }

                if($request->hasFile('national_insurance_number')) {
                    $national_insurance_number = $request->file('national_insurance_number');
                    $national_insurance_number_fileName = $email.'/_national_insurance_number.'. $national_insurance_number->getClientOriginalExtension();
                    $teacher_credential->national_insurance_number = $national_insurance_number_fileName;
                    $this->uploadFile($national_insurance_number_fileName, $national_insurance_number);
                }

                if($request->hasFile('permit_or_id')) {
                    $permit_or_id = $request->file('permit_or_id');
                    $permit_or_id_fileName = $email.'/_permit_or_id.'. $permit_or_id->getClientOriginalExtension();
                    $teacher_credential->permit_or_id = $permit_or_id_fileName;
                    $this->uploadFile($permit_or_id_fileName, $permit_or_id);
                }

                if($request->hasFile('signature')) {
                    $signature = $request->file('signature');
                    $signature_fileName = $email.'/_signature.'. $signature->getClientOriginalExtension();
                    $teacher_credential->signature = $signature_fileName;
                    $this->uploadFile($signature_fileName, $signature);
                }

                $teacher_credential->save();
            }

            UserSignedUp::dispatch($user);
            return response()->json($user);
        }
    }


    /**
     * Check if User Email exist.
     *
     * @param string $email
     */
    public function existEmail(Request $request, $email) {
        if(User::where('email', $email)->first()) {
            return true; 
        }
        return false;
    }

    /**
     * Check if User Phone exist.
     *
     * @param string $phone
     */
    public function existPhone(Request $request, $phone) {
        if(User::where('phone', $phone)->first()) {
            return true; 
        }
        return false;
    }

   

    /**
     * Get all authenticated Users.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAll() {
        $users  = User::all();

        if($users) {
            return response()->json($users);
        }
    }


    /**
     * Get User by id.
     *
     * @param  integer $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function showOne($id) {
        $user  = User::findOrFail($id);

        if($user) {
            return response()->json($user);
        }
    }

	/**
     * Get current authenticated User.
     *
     * @param  integer $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function showUser() {
        $user  = Auth::user();

        if($user) {
            return response()->json($user);
        }
    } 


    /**
     * Update User.
     *
     * @param  integer $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        $user  = User::findOrFail($id);

        if(!$user) {
            return response()->json([
                'message' => 'User not found'
            ]);
        }

        
        $user->name = $request->input('name') ? $request->input('name') : $user->name;
        
        $old_email = $user->email;
        $email = $request->input('email') ? $request->input('email') : $old_email;
        $user->email = $email;

        $user->phone = $request->input('phone') ? $request->input('phone') : $user->phone;
        $user->role = $request->input('role') ? $request->input('role') : $user->role;
        $user->password = $request->input('password') ? Hash::make($request->input('password')) : $user->password;

        $profile_picture = $request->file('profile_picture') ? $request->file('profile_picture') : null;
        $profile_picture_fileName = $profile_picture ? $email.'/_profile_picture.'. $profile_picture->getClientOriginalExtension() : null;
        
        $user->profile = $request->input('profile') ? $request->input('profile') : $user->profile;
        $user->subjects = $request->input('subjects') ? $request->input('subjects') : $user->subjects;          

        if($user->save()) {
            $profile_picture_fileName ? $this->uploadFile($profile_picture_fileName, $profile_picture) : null;

            if($user->role === 'teacher') {
                $teacher_credential = TeacherCredential::where('email', $old_email)->first();
                
                $teacher_credential->name = $request->input('name') ? $request->input('name') : $teacher_credential->name; 
		        $teacher_credential->email = $email;
                $teacher_credential->phone = $request->input('phone') ? $request->input('phone') : $teacher_credential->phone;
		
                $teacher_credential->ref_name = $request->input('ref_name') ? $request->input('ref_name') : $teacher_credential->ref_name; 
		        $teacher_credential->ref_email = $request->input('ref_email') ? $request->input('ref_email') : $teacher_credential->ref_email;  
                $teacher_credential->ref_phone = $request->input('ref_phone') ? $request->input('ref_phone') : $teacher_credential->ref_phone; 
                $teacher_credential->ref_relationship = $request->input('ref_relationship') ? $request->input('ref_relationship') : $teacher_credential->ref_relationship;
                $teacher_credential->ref_organisation = $request->input('ref_organisation') ? $request->input('ref_organisation') : $teacher_credential->ref_organisation;
                $teacher_credential->ref_position = $request->input('ref_position') ? $request->input('ref_position') : $teacher_credential->ref_position;
                
                if($request->hasFile('right_to_work')) {
                    $right_to_work = $request->file('right_to_work');
                    $right_to_work_fileName = $email.'/_right_to_work.'. $right_to_work->getClientOriginalExtension();
                    $teacher_credential->right_to_work = $right_to_work_fileName;
                    $this->uploadFile($right_to_work_fileName, $right_to_work);
                }

                if($request->hasFile('dbs_certificate')) {
                    $dbs_certificate = $request->file('dbs_certificate');
                    $dbs_certificate_fileName = $email.'/_dbs_certificate.'. $dbs_certificate->getClientOriginalExtension();
                    $teacher_credential->dbs_certificate = $dbs_certificate_fileName;
                    $this->uploadFile($dbs_certificate_fileName, $dbs_certificate);
                }

                if($request->hasFile('educational_qualification')) {
                    $educational_qualification = $request->file('educational_qualification');
                    $educational_qualification_fileName = $email.'/_educational_qualification.'. $educational_qualification->getClientOriginalExtension();
                    $teacher_credential->educational_qualification = $educational_qualification_fileName;
                    $this->uploadFile($educational_qualification_fileName, $educational_qualification);
                }

                if($request->hasFile('qts')) {
                    $qts = $request->file('qts');
                    $qts_fileName = $email.'/_qts.'. $qts->getClientOriginalExtension();
                    $teacher_credential->qts = $qts_fileName;
                    $this->uploadFile($qts_fileName, $qts);
                }

                if($request->hasFile('passport_id_or_driver_license')) {
                    $passport_id_or_driver_license = $request->file('passport_id_or_driver_license');
                    $passport_id_or_driver_license_fileName = $email.'/_passport_id_or_driver_license.'. $passport_id_or_driver_license->getClientOriginalExtension();
                    $teacher_credential->passport_id_or_driver_license = $passport_id_or_driver_license_fileName;
                    $this->uploadFile($passport_id_or_driver_license_fileName, $passport_id_or_driver_license);
                }

                if($request->hasFile('passport_photo')) {
                    $passport_photo = $request->file('passport_photo');
                    $passport_photo_fileName = $email.'/_passport_photo.'. $passport_photo->getClientOriginalExtension();
                    $teacher_credential->passport_photo = $passport_photo_fileName;
                    $this->uploadFile($passport_photo_fileName, $passport_photo);
                }

                if($request->hasFile('profile_picture')) {
                    $proof_of_address = $request->file('proof_of_address');
                    $proof_of_address_fileName = $email.'/_proof_of_address.'. $proof_of_address->getClientOriginalExtension();
                    $teacher_credential->proof_of_address = $proof_of_address_fileName;
                    $this->uploadFile($proof_of_address_fileName, $proof_of_address);
                }

                if($request->hasFile('national_insurance_number')) {
                    $national_insurance_number = $request->file('national_insurance_number');
                    $national_insurance_number_fileName = $email.'/_national_insurance_number.'. $national_insurance_number->getClientOriginalExtension();
                    $teacher_credential->national_insurance_number = $national_insurance_number_fileName;
                    $this->uploadFile($national_insurance_number_fileName, $national_insurance_number);
                }

                if($request->hasFile('permit_or_id')) {
                    $permit_or_id = $request->file('permit_or_id');
                    $permit_or_id_fileName = $email.'/_permit_or_id.'. $permit_or_id->getClientOriginalExtension();
                    $teacher_credential->permit_or_id = $permit_or_id_fileName;
                    $this->uploadFile($permit_or_id_fileName, $permit_or_id);
                }

                if($request->hasFile('signature')) {
                    $signature = $request->file('signature');
                    $signature_fileName = $email.'/_signature.'. $signature->getClientOriginalExtension();
                    $teacher_credential->signature = $signature_fileName;
                    $this->uploadFile($signature_fileName, $signature);
                }
                
                $teacher_credential->save();
            }

            UserUpdated::dispatch($user);
            return response()->json($user);
        }
    }


    /**
     * Delete User.
     *
     * @param  integer $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {
        $user  = User::findOrFail($id);

        if($user->delete()) {
            return response()->json([
                'message' => 'User Deleted'
            ]);
        }
    }

     /**
     * Upload user file.
     *
     * @param  string $email
     * 
     * @return void
     */
    public function uploadFile($filename, $file) {
        Storage::putFileAs('public/', $file, $filename);
    }

     /**
     * Upload user file.
     *
     * @param  string $email
     * 
     * @return void
     */
    public function updateFile($filename, $file) {
        if($this->deleteFile($filename)) {
            $this->uploadFile($filename, $file);
        };
        
    }


    /**
     * Download user file
     *
     * @param  string $filename
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function downloadFile($email, $name) {
        $filename = $email. '/' .$name;
        if(Storage::disk('local')->exists('public/'.$filename)) {
            return Storage::download('public/'.$filename, $email.$name);
        }

        return response()->json([
            'error' => 'file does not exist'
        ]);
    }

    /**
     * Delete user file
     *
     * @param  string $filename
     * 
     * @return void
     */
    public function deleteFile($filename) { // ===not functional
        if(Storage::disk('local')->exists('public/'.$filename)) {
            Storage::disk('local')->delete('public/'.$filename); 
        }
        
    }

    /**
     * get user file.
     *
     * @param  string $filenmame
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFileUrl($email, $name) {
        $filename = $email. '/' .$name; 
        if(Storage::disk('local')->exists('public/'.$filename)) {
            $url = Storage::url("public/".$filename);

            return response()->json([
                'fileUrl' => $url
            ]);
        }

        return response()->json([
            'error' => 'file does not exist'
        ]);
    }

}
