<?php

namespace App\Models\Courses;

/**
 *
 * @property ?Grade grade
 */

use App\Models\BaseModel;
use App\Models\Grades\Grade;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courses extends BaseModel
{
    use SoftDeletes;

    protected $table = 'courses';

    protected $fillable = [
        'name',
        'grade_id',
    ];

    public function grade() : HasOne
    {
        return $this->HasOne(Grade::class, 'id','grade_id');
    }
}
