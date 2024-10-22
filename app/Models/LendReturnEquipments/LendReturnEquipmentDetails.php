<?php

namespace App\Models\LendReturnEquipments;

use App\Helpers;
use App\Models\BaseModel;
use App\Models\Courses\CoursesDetails;
use App\Models\Equipments\Equipment;
use App\Models\TypeOfEquipments\TypeOfEquipment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'course_details_id',
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

    public function typeOfEquipment() : BelongsTo
    {
        return $this->BelongsTo(TypeOfEquipment::class, 'type_of_equipment_id', 'id');
    }

    public function courseDetails() : BelongsTo
    {
        return $this->BelongsTo(CoursesDetails::class, 'course_details_id', 'id');
    }
}
