<?php

namespace App\Imports;

use App\Models\Class\Classes;
use App\Models\Grades\Grade;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClassesImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $grade_id = Grade::query()->where('name' , '=', $row['grade'])->first();
        $grade_id = $grade_id ? $grade_id->id : null;
        return new Classes([
            "grade_id" => $grade_id,
            "name" => $row['name'],
            "number_of_pupils" => $row['number_of_pupils'],
        ]);
    }
}