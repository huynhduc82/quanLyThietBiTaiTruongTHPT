<?php

namespace App\Models\EquipmentReservations;

use App\Helpers;
use App\Models\BaseModel;
use App\Models\Equipments\Equipment;
use App\Models\TypeOfEquipments\TypeOfEquipment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @property ?Equipment equipments
 */

class EquipmentReservationDetails extends BaseModel
{
    use SoftDeletes;

    protected $table = 'equipment_reservation_details';

    protected $fillable = [
        'type_of_equipment_id',
        'equipment_reservation_id',
        'equipment_details',
        'quantity',
    ];

    public function equipments() : BelongsToMany
    {
        return $this->belongsToMany(
            Equipment::class,
            'equipment_reservation_pivot',
            'reservation_id',
            'equipment_details');
    }

    public function getEquipmentIDAttribute($value): ?array
    {
        if (!empty($value)) {
            return explode(Helpers::SEPARATOR, $value);
        }
        return null;
    }

    public function typeOfEquipment() : BelongsTo
    {
        return $this->BelongsTo(TypeOfEquipment::class, 'type_of_equipment_id', 'id');
    }
}
