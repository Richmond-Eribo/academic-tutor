<?php

namespace App\Http\Controllers;

use App\Events\UserSignedUp;
use App\Events\UserUpdated;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Store User data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $user = new User();

        $user->name = $request->input('name');
        $email = $request->input('email');
        $user->email = $email;
        $user->phone = $request->input('phone');
        $user->relationship = $request->input('relationship');
        $user->organisation = $request->input('organisation');
        $user->position = $request->input('position');
        $user->profile = $request->input('profile');
        $user->subjects = $request->input('subjects');
        $user->role = $request->input('role');
        $user->password = Hash::make($request->input('password'));

        $PermitOrId = $request->file('permit_or_id');
        $PermitOrId_fileName = 'permit_id/'.time().'_'. $email.'_'.$PermitOrId->getClientOriginalName();
        
        $signature = $request->file('signature');
        $signature_fileName = 'signature/'.time().'_'. $email.'_'.$signature->getClientOriginalName();
        
        $profilePicture = $request->file('profile_picture');
        $profilePicture_fileName = 'profile_picture/'.time().'_'. $email.'_'.$profilePicture->getClientOriginalName();

        $user->permit_or_id = $PermitOrId_fileName;
        $user->signature = $signature_fileName;
        $user->profile_picture = $profilePicture_fileName;

        $this->uploadFile($PermitOrId_fileName, $PermitOrId);
        $this->uploadFile($signature_fileName, $signature);
        $this->uploadFile($profilePicture_fileName, $profilePicture);

        if($user->save()) {
            UserSignedUp::dispatch($user);
            return response()->json($user);
        }
    }


    /**
     * Upload user file.
     *
     * @param  string $email
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFile($filename, $file) {
        return Storage::disk('local')->put($filename, $file);
    }


    /**
     * Update user files.
     *
     */
    public function updateFile($old_filename, $new_filename, $file) {
        $this->deleteFile($old_filename);
        return $this->uploadFile($new_filename, $file);
    }

    /**
     * Download user file
     *
     * @param  string $filename
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function downloadFile($filename) {
        if(Storage::disk('local')->exists($filename)) {
            $file = Storage::disk('local')->get($filename);
            return response()->download($file, $filename);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFile($filename) {
        if(Storage::disk('local')->exists($filename)) {
            return Storage::disk('local')->delete($filename);;
        }

        return response()->json([
            'error' => 'file does not exist'
        ]);
    }

    /**
     * get user file.
     *
     * @param  string $filenmame
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFile($filename) {
        if(Storage::disk('local')->exists($filename)) {
            $file = Storage::disk('local')->get($filename);

            return response($file, 200)->header('Content-Type', 'image/*');
        }

        return response()->json([
            'error' => 'file does not exist'
        ]);
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
     * Get one authenticated User.
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
     * Update User.
     *
     * @param  integer $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        $user  = User::findOrFail($id);

        $user->name = $request->input('name') ? $request->input('name') : $user->name;
        $email = $request->input('email') ? $request->input('email') : $user->email;
        $user->email = $email;
        $user->phone = $request->input('phone') ? $request->input('phone') : $user->phone;
        $user->relationship = $request->input('relationship') ? $request->input('relationship') : $user->relationship;
        $user->organisation = $request->input('organisation') ? $request->input('organisation') : $user->organisation;
        $user->position = $request->input('position') ? $request->input('position') : $user->position;
        $user->profile = $request->input('profile') ? $request->input('profile') : $user->profile;
        $user->subjects = $request->input('subjects') ? $request->input('subjects') : $user->subjects;
        $user->role = $request->input('role') ? $request->input('role') : $user->role;
        $user->password = $request->input('password') ? Hash::make($request->input('password')) : $user->password;

        if($request->file('permit_or_id')) {
            $old_permitOrId_fileName = $user->permit_or_id;
            $permitOrId = $request->file('permit_or_id');
            $new_permitOrId_fileName = 'permit_id/'.time().'_'.$email.'_'.$permitOrId->getClientOriginalName();
            $this->updateFile($old_permitOrId_fileName, $new_permitOrId_fileName, $permitOrId);
        }

        if($request->file('signature')) {
            $old_signature_fileName = $user->signature;
            $signature = $request->file('signature');
            $new_signature_fileName = 'signature/'.time().'_'.$email.'_'.$signature->getClientOriginalName();
            $this->updateFile($old_signature_fileName, $new_signature_fileName, $signature);
        }

        if($profilePicture = $request->file('profile_picture')) {
            $old_profilePicture_fileName = $user->profile_picture;
            $profilePicture = $request->file('profile_picture');
            $new_profilePicture_fileName = 'profile_picture/'.time().'_'.$email.'_'.$profilePicture->getClientOriginalName();
            $this->updateFile($old_profilePicture_fileName, $new_profilePicture_fileName, $profilePicture);
        }

        if($user->save()) {
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
}
