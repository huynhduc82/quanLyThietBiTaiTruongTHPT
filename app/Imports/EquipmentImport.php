<?php

namespace App\Imports;

use App\Models\Grades\Grade;
use App\Models\TypeOfEquipments\TypeOfEquipment;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EquipmentImport implements ToModel,WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        return new TypeOfEquipment([
            "name" => $row['name'],
            "price" => $row['price'],
            "unit" => $row['unit'],
        ]);
    }
}
