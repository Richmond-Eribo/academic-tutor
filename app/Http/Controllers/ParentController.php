<?php

namespace App\Http\Controllers;

use App\Events\TeacherRequestedFor;
use App\Events\TeacherRequestedForCancelled;
use App\Models\ParentRequests;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentController extends Controller
{
    /**
     * Get all Parents.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAll()
    {
        $parents = User::where('role', 'parent')->get();

        if(!$parents) {
            return response()->json([
                'message' => 'Not a Parent'
            ]);
        }
        return response()->json($parents);
    }

    
    /**
     * Get one Parent.
     *
     * @param  integer $id
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function showOne($id)
    {
        $parent = User::where('role', 'parent')
                    ->where('id', $id)
                    ->get();

        if(!$parent) {
            return response()->json([
                'message' => 'Not a Parent'
            ]);
        }
        return response()->json($parent);
    }

}
