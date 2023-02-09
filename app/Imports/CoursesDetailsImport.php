<?php

namespace App\Imports;

use App\Models\Courses\Courses;
use App\Models\Courses\CoursesDetails;
use App\Models\Grades\Grade;
use App\Models\SpecifyTheNumberOfEquipments\SpecifyTheNumberOfEquipment;
use App\Models\TypeOfEquipments\TypeOfEquipment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CoursesDetailsImport implements ToCollection,WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $equipment = TypeOfEquipment::all();
            $grade_id = Grade::query()->where('name' , '=', $row['grade'])->first();
            $grade_id = $grade_id ? $grade_id->id : null;
            $course_id = Courses::query()->where('name', '=', $row['course'])
                ->where('grade_id', '=', $grade_id)->first();
            $course_id = $course_id ? $course_id->id : null;
            $model = CoursesDetails::create([
                "course_id" => $course_id,
                "lesson" => $row['lesson'],
                "describe" => $row['describe'],
                "need_equipment" => (bool)$row['need_equipment'],
            ]);
            if($row['need_equipment'] = 1)
            {
                for ($i = 1 ; $i <= $row['total_equipment']; $i++)
                {
                    if($row['equipment' . $i])
                    {
                        $id = $equipment->where('name', '=', $row['equipment' . $i])->first()->id;
                        SpecifyTheNumberOfEquipment::create([
                            "equipment_id" => $id,
                            "course_details_id" => $model->id,
                            "quantity" => $row['quantity' . $i]
                        ]);
                    }

//                    if($row['equipment2'])
//                    {
//                        $id = $equipment->where('name', '=', $row['equipment2'])->first()->id;
//                        SpecifyTheNumberOfEquipment::create([
//                            "equipment_id" => $id,
//                            "course_details_id" => $model->id,
//                            "quantity" => $row['quantity2']
//                        ]);
//                    }
//
//                    if($row['equipment3'])
//                    {
//                        $id = $equipment->where('name', '=', $row['equipment3'])->first()->id;
//                        SpecifyTheNumberOfEquipment::create([
//                            "equipment_id" => $id,
//                            "course_details_id" => $model->id,
//                            "quantity" => $row['quantity3']
//                        ]);
//                    }
//
//                    if($row['equipment4'])
//                    {
//                        $id = $equipment->where('name', '=', $row['equipment4'])->first()->id;
//                        SpecifyTheNumberOfEquipment::create([
//                            "equipment_id" => $id,
//                            "course_details_id" => $model->id,
//                            "quantity" => $row['quantity4']
//                        ]);
//                    }
//
//                    if($row['equipment5'])
//                    {
//                        $id = $equipment->where('name', '=', $row['equipment5'])->first()->id;
//                        SpecifyTheNumberOfEquipment::create([
//                            "equipment_id" => $id,
//                            "course_details_id" => $model->id,
//                            "quantity" => $row['quantity5']
//                        ]);
//                    }
                }
            }
        }
    }
}
