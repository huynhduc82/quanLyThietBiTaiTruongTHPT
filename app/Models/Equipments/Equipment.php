<?php

namespace App\Models\Equipments;

use App\Models\BaseModel;
use App\Models\EquipmentReservations\EquipmentReservationDetails;
use App\Models\EquipmentStatus\EquipmentStatus;
use App\Models\Rooms\Room;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @property ?EquipmentStatus status
 * @property ?Room room
 */

class Equipment extends BaseModel
{
    const NAME_MIN_LENGTH = 3;
    const NAME_MAX_LENGTH = 254;

    use SoftDeletes;

    protected $table = 'equipment';

    protected $fillable = [
        'room_id',
        'equipment_status_id',
        'type_of_equipment_id',
        'name',
        'can_rent',
    ];

    public function status() : HasOne
    {
        return $this->hasOne(EquipmentStatus::class, 'id', 'equipment_status_id');
    }

    public function room() : HasOne
    {
        return $this->hasOne(Room::class, 'id', 'room_id');
    }

    public function reservation() : BelongsToMany
    {
        return $this->belongsToMany(
            EquipmentReservationDetails::class
        );
    }
}
