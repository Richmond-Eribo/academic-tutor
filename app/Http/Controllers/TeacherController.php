<?php

namespace App\Http\Controllers;

use App\Events\TeacherUnVerified;
use App\Events\TeacherVerified;
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
     * Verify Teacher.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify($id)
    {               ;
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();
        if(!$teacher) {
            return response()->json([
                'message' => 'Not a Teacher'
            ]);
        }

        $teacher->verified = 1;
        if($teacher->save()) {
            TeacherVerified::dispatch($teacher);
            return response()->json($teacher);
        }
    }


    /**
     * Get all verified Teachers.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAllVerified()
    {
        $verified_teachers = User::where('role', 'teacher')
                    ->where('verified', 1)
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
        $verified_teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->where('verified', 1)
                    ->get();

        return response()->json($verified_teacher);
    }


    /**
     * Unverify Teacher.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function unverify($id)
    {
        $teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->first();

        $teacher->verified = 0;
        if($teacher->save()) {
            TeacherUnVerified::dispatch($teacher);
            return response()->json($teacher);
        }
    }


    /**
     * Get all not verified Teachers.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAllNotVerified()
    {
        $not_verified_teachers = User::where('role', 'teacher')
                    ->where('verified', 0)
                    ->get();

        return response()->json($not_verified_teachers);
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
        $not_verified_teacher = User::where('role', 'teacher')
                    ->where('id', $id)
                    ->where('verified', 0)
                    ->get();

        return response()->json($not_verified_teacher);
    }

}
