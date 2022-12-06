<?php

namespace App\Models\ImportEquipments;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImportEquipment extends BaseModel
{
    use SoftDeletes;

    protected $table = 'import_equipment';

    protected $fillable = [
        'user_id',
        'approved_by',
    ];
}
