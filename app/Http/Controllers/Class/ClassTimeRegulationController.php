<?php

namespace App\Http\Controllers\Class;

use App\Http\Controllers\Controller;
use App\Models\Class\ClassTimeRegulations;
use App\Transformers\Class\ClassTimeRegulationsTransformers;

class ClassTimeRegulationController extends Controller
{
    public function index(){
        return $this->transform(ClassTimeRegulations::get(), ClassTimeRegulationsTransformers::class);
    }
}
