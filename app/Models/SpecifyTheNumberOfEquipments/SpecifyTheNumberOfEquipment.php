<?php

namespace App\Models\SpecifyTheNumberOfEquipments;

use App\Models\BaseModel;
use App\Models\TypeOfEquipments\TypeOfEquipment;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @property ?TypeOfEquipment equipment
 */

class SpecifyTheNumberOfEquipment extends BaseModel
{
    use SoftDeletes;

    protected $table = 'specify_the_number_of_equipment';

    protected $fillable = [
        'equipment_id',
        'course_details_id',
        'quantity',
    ];

    public function equipment(): HasOne
    {
        return $this->hasOne(TypeOfEquipment::class, 'id', 'equipment_id');
    }
}
