<?php

namespace App\Models\Class;

/**
 *
 * @property ?Grade grade
 */

use App\Models\BaseModel;
use App\Models\Grades\Grade;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classes extends BaseModel
{
    use SoftDeletes;

    const NAME_MIN_LENGTH = '3';
    const NAME_MAX_LENGTH = '255';

    const NUMBER_OF_PUPILS_MIN = '15';
    const NUMBER_OF_PUPILS_MAX = '70';

    protected $table = 'classes';

    protected $fillable = [
        'grade_id',
        'name',
        'number_of_pupils',
    ];

    public function grade() : BelongsTo
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }
}
