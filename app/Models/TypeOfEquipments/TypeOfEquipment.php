<?php

namespace App\Models\TypeOfEquipments;

use App\Models\BaseModel;
use App\Models\Equipments\Equipment;
use App\Models\ImageInfos\ImageInfo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @property ?Equipment equipments
 * @property ?ImageInfo imagesInfo
 */

class TypeOfEquipment extends BaseModel
{
    const PRICE_MIN = 1000;
    const PRICE_MAX = 999999999;

    const NAME_MIN_LENGTH = 3;
    const NAME_MAX_LENGTH = 254;

    const UNIT_MIN_LENGTH = 3;
    const UNIT_MAX_LENGTH = 254;

    const DESCRIBE_MIN_LENGTH = 3;
    const DESCRIBE_MAX_LENGTH = 254;

    use SoftDeletes;

    protected $table = 'type_of_equipment';

    protected $fillable = [
        'name',
        'price',
        'unit',
        'describe',
        'images',
        'image_references',
    ];
    private mixed $equipments;

    public function equipments() : HasMany
    {
        return $this->hasMany(Equipment::class, 'type_of_equipment_id', 'id');
    }

    public function imagesInfo() : BelongsTo
    {
        return $this->belongsTo(ImageInfo::class, 'image_references', 'image_references');
    }
}
