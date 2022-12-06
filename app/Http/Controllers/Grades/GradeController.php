<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Models\Grades\Grade;
use App\Transformers\Grades\GradeTransformers;

class GradeController extends Controller
{
    public function index()
    {
        return $this->response($this->transform(Grade::get(), GradeTransformers::class));
    }
}
