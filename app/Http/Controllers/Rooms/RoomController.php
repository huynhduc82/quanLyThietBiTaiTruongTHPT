<?php

namespace App\Http\Controllers\Rooms;

use App\Http\Controllers\Controller;
use App\Services\Rooms\RoomServices;
use Illuminate\Support\Facades\Request;

class RoomController extends Controller
{
    public function __construct(
        protected RoomServices $roomServices
    )
    {
    }

    public function index()
    {
        $include = [

        ];

        $this->roomServices->index($include);
    }

    public function store(Request $request)
    {
        $input = $request::all();

        $result = $this->roomServices->store($input);

        return $this->response($result);
    }

    public function show($id)
    {

    }


    public function update()
    {

    }

    public function destroy($id)
    {

    }
}
