<?php

namespace App\Models\Courses;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoursesDetails extends BaseModel
{
    use SoftDeletes;

    const LESSON_MIN_LENGTH = '1';
    const LESSON_MAX_LENGTH = '255';

    const DESCRIBE_MIN_LENGTH = '3';
    const DESCRIBE_MAX_LENGTH = '255';

    protected $table = 'course_details';

    protected $fillable = [
        'course_id',
        'lesson',
        'describe',
        'need_equipment',
    ];

    public function course() : BelongsTo
    {
        return $this->belongsTo(Courses::class, 'course_id', 'id');
    }
}
