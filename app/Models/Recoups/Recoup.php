<?php

namespace App\Models\Recoups;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recoup extends BaseModel
{
    use SoftDeletes;

    protected $table = 'recoup';

    protected $fillable = [
        'equipment_id',
        'reason',
        'recoup_method',
        'quantity',
        'amount_of_money'
    ];
}
