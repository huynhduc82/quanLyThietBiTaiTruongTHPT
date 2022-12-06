<?php

namespace App\Models\Class;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classes extends BaseModel
{
    use SoftDeletes;

    protected $table = 'classes';

    protected $fillable = [
        'grade_id',
        'name',
        'number_of_pupils',
    ];
}
