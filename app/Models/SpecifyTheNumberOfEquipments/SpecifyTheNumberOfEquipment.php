<?php

namespace App\Models\SpecifyTheNumberOfEquipments;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecifyTheNumberOfEquipment extends BaseModel
{
    use SoftDeletes;

    protected $table = 'specify_the_number_of_equipment';

    protected $fillable = [
        'equipment_id',
        'course_details_id',
        'quantity',
    ];
}
