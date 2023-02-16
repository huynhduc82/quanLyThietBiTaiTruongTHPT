<?php

namespace App\Models\Recoups;

use App\Models\BaseModel;
use App\Models\Equipments\Equipment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recoup extends BaseModel
{
    use SoftDeletes;

    const MONEY_METHOD = 'money';
    const EQUIPMENT_METHOD = 'equipment';

    protected $table = 'recoup';

    protected $fillable = [
        'equipment_id',
        'reason',
        'recoup_method',
        'quantity',
        'amount_of_money'
    ];

    public function equipment() : BelongsTo
    {
        return $this->belongsTo(Equipment::class, 'equipment_id', 'id');
    }
}
