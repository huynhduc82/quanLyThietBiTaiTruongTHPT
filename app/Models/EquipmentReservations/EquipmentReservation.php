<?php

namespace App\Models\EquipmentReservations;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @property ?EquipmentReservationDetails $details
 */

class EquipmentReservation extends BaseModel
{
    const STATUS_NEW = 'new';
    const STATUS_CANCEL = 'cancel';
    const STATUS_APPROVED = 'approved';
    const STATUS_CHECKED = 'checked';

    const ATTRIBUTE_STORE = [
        'user_id',
        'pick_up_time',
        'return_appointment_time',
        'status',
    ];

    use SoftDeletes;

    protected $table = 'equipment_reservation';

    protected $fillable = [
        'user_id',
        'pick_up_time',
        'return_appointment_time',
        'status',
    ];

    public function details() : HasMany
    {
        return $this->hasMany(EquipmentReservationDetails::class, 'equipment_reservation_id', 'id');
    }
}
