<?php

namespace App\Models\Courses;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoursesDetails extends BaseModel
{
    use SoftDeletes;

    protected $table = 'course_details';

    protected $fillable = [
        'course_id',
        'lesson',
        'describe',
        'need_equipment',
    ];
}
