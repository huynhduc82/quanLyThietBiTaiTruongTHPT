<?php

namespace App\Models\Grades;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends BaseModel
{
    use SoftDeletes;

    protected $table = 'grades';

    protected $fillable = [
        'name',
    ];
}
