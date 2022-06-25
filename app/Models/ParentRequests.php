<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentRequests extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'parent_name',
        'parent_email',
        'parent_phone',
        'teacher_id',
        'teacher_name',
        'teacher_email',
        'teacher_phone',
    ];
}
