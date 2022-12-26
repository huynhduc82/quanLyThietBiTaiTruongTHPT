<?php

namespace App\Models\Courses;

/**
 *
 * @property ?Grade grade
 * @property ?CoursesDetails courseDetails
 */

use App\Models\BaseModel;
use App\Models\Grades\Grade;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courses extends BaseModel
{
    use SoftDeletes;

    const NAME_MIN_LENGTH = '3';
    const NAME_MAX_LENGTH = '255';

    protected $table = 'courses';

    protected $fillable = [
        'name',
        'grade_id',
    ];

    public function grade() : HasOne
    {
        return $this->HasOne(Grade::class, 'id','grade_id');
    }

    public function courseDetails() : HasMany
    {
        return $this->hasMany(CoursesDetails::class , 'course_id', 'id');
    }
}
