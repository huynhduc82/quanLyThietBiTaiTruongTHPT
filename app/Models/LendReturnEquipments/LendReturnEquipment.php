<?php

namespace App\Models\LendReturnEquipments;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class LendReturnEquipment extends BaseModel
{
    const ATTRIBUTE_TO_LEND = [
        'user_id',
        'pick_up_time',
        'lender_id',
        'return_appointment_time',
        'room_id',
    ];

    const ATTRIBUTE_TO_RETURN = [
        'user_id',
        'return_time',
        'returner_id',
    ];

    use SoftDeletes;

    protected $table = 'lend_return_equipment';

    protected $fillable = [
        'user_id',
        'pick_up_time',
        'lender_id',
        'returner_id',
        'return_time',
        'room_id',
        'return_appointment_time',
    ];
}
