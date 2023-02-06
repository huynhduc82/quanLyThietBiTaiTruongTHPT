<?php

namespace App\Models\EquipmentReservations;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @property ?EquipmentReservationDetails $details
 */

class EquipmentReservation extends BaseModel
{
    const STATUS_NEW = 1;
    const STATUS_CANCEL = 2;
    const STATUS_APPROVED = 3;
    const STATUS_LEND = 4;

    const ATTRIBUTE = [
        'user_id',
        'pick_up_time',
        'return_appointment_time',
        'status',
        'course_details_id',
    ];

    use SoftDeletes;

    protected $table = 'equipment_reservation';

    protected $fillable = [
        'user_id',
        'pick_up_time',
        'return_appointment_time',
        'status',
        'course_details_id',
    ];

    public function details() : HasMany
    {
        return $this->hasMany(EquipmentReservationDetails::class, 'equipment_reservation_id', 'id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
