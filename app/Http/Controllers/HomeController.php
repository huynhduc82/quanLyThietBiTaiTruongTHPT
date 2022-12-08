<?php

namespace App\Http\Controllers;

use App\Models\TypeOfEquipments\TypeOfEquipment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $include = [
            'imagesInfo'
        ];
        $type = TypeOfEquipment::query()->where('id',5)->with($include)->first();

        return view('welcome')->with(compact('type'));
    }
}
