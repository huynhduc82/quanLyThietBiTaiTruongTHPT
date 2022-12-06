<?php

namespace App\Models\Courses;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courses extends BaseModel
{
    use SoftDeletes;

    protected $table = 'courses';

    protected $fillable = [
        'name',
        'grade_id',
    ];
}
