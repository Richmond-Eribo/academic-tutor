<?php

namespace App\Http\Controllers;

use App\Events\TeacherUnVerified;
use App\Events\TeacherVerified;
use App\Models\TeacherCredential;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Get all Teachers.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAll()
    {
        $teachers = User::where('role', 'teacher')->get();

        return response()->json($teachers);
    }


    /**
     * Get one Teacher.
     *
     * @param  integer $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function showOne($id)
    {
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();

        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }
        return response()->json($teacher);
    }


    /**
     * Get all verified Teachers.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAllVerified()
    {
        $verified_teachers = TeacherCredential::where('verified', true)
                                                ->get();

        return response()->json($verified_teachers);
    }


    /**
     * Get one verified Teacher.
     *
     * @param  integer $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function showOneVerified($id)
    {
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();

        $verified_teacher = TeacherCredential::where('email', $teacher->email)
                    ->where('verified', true)
                    ->first();
        

        return response()->json($verified_teacher);
    }


    /**
     * Get all not verified Teachers.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAllNotVerified()
    {
        $verified_teachers = TeacherCredential::where('verified', false)
                                                ->get();

        return response()->json($verified_teachers);
    }


    /**
     * Get one not verified Teacher.
     *
     * @param  integer $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function showOneNotVerified($id)
    {
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();

        $verified_teacher = TeacherCredential::where('email', $teacher->email)
                    ->where('verified', true)
                    ->first();
                    
        return response()->json($verified_teacher);
    }

}
