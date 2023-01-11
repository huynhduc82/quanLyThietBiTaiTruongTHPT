<?php

namespace App\Models\LendReturnEquipments;

use App\Models\BaseModel;
use App\Models\Rooms\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @property ?LendReturnEquipmentDetails $details
 */


class LendReturnEquipment extends BaseModel
{
    const STATUS_LENDING = 1;
    const STATUS_RETURNED = 2;
    const STATUS_OUT_OF_DATE = 3;

    const ATTRIBUTE_TO_LEND = [
        'user_id',
        'pick_up_time',
        'lender_id',
        'return_appointment_time',
        'room_id',
        'status',
    ];

    const ATTRIBUTE_TO_RETURN = [
        'return_time',
        'returner_id',
        'status',
    ];

    const ATTRIBUTE_TO_UPDATE = [
        self::ATTRIBUTE_TO_LEND,
        self::ATTRIBUTE_TO_RETURN
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

    public function details() : HasMany
    {
        return $this->hasMany(LendReturnEquipmentDetails::class, 'lend_return_equipment_id', 'id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function lender() : BelongsTo
    {
        return $this->belongsTo(User::class, 'lender_id', 'id');
    }

    public function returner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'returner_id', 'id');
    }

    public function room() : BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
}
