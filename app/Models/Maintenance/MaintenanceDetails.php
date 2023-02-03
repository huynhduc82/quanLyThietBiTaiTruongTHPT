<?php

namespace App\Models\Maintenance;

use App\Models\BaseModel;
use App\Models\Equipments\Equipment;
use App\Models\TypeOfEquipments\TypeOfEquipment;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @property ?Maintenance $maintenance
 */

class MaintenanceDetails extends BaseModel
{
    use SoftDeletes;

    protected $table = 'maintenance_details';

    protected $fillable = [
        'maintenance_id',
        'type_of_equipment_id',
        'equipment_id',
    ];

    public function equipments() : BelongsToMany
    {
        return $this->belongsToMany(
            Equipment::class,
            'equipment_maintenance_pivot',
            'maintenance_id',
            'equipment_id');
    }

    public function typeOfEquipment() : BelongsTo
    {
        return $this->BelongsTo(TypeOfEquipment::class, 'type_of_equipment_id', 'id');
    }
}
