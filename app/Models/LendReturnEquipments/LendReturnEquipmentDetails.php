<?php

namespace App\Models\LendReturnEquipments;

use App\Helpers;
use App\Models\BaseModel;
use App\Models\Equipments\Equipment;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @property ?LendReturnEquipmentDetails $details
 */

class LendReturnEquipmentDetails extends BaseModel
{
    use SoftDeletes;

    protected $table = 'lend_return_equipment_details';

    protected $fillable = [
        'lend_return_equipment_id',
        'equipment_details',
        'quantity',
        'equipment_status_id',
        'recoup_id',
        'type_of_equipment_id',
    ];

    public function equipments() : BelongsToMany
    {
        return $this->belongsToMany(
            Equipment::class,
            'equipment_lend_return_pivot',
            'lend_return_id',
            'equipment_id');
    }

    public function getEquipmentIDAttribute($value): ?array
    {
        if (!empty($value)) {
            return explode(Helpers::SEPARATOR, $value);
        }
        return null;
    }
}
