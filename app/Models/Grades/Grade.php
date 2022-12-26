<?php

namespace App\Models\Grades;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends BaseModel
{
    use SoftDeletes;

    const NAME_MIN_LENGTH = '1';
    const NAME_MAX_LENGTH = '255';

    protected $table = 'grades';

    protected $fillable = [
        'name',
    ];
}
