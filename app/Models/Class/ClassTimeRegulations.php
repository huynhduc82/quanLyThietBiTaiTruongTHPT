<?php

namespace App\Models\Class;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassTimeRegulations extends BaseModel
{
    use SoftDeletes;

    protected $table = 'class_time_regulations';

    protected $fillable = [
        'lesson',
        'start',
        'end',
    ];
}
