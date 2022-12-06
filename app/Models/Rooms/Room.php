<?php

namespace App\Models\Rooms;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends BaseModel
{
    const NAME_MIN_LENGTH = 3;
    const NAME_MAX_LENGTH = 254;

    use SoftDeletes;

    protected $table = 'room';

    protected $fillable = [
        'name',
        'can_rent',
    ];

}
