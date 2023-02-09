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

    public function storeView()
    {
        $include = [

        ];

        $data = $this->roomServices->index($include);

        return view('room/store')->with(compact('data'));
    }

    public function editView($id)
    {
        $include = [

        ];

        $data = $this->roomServices->details($id, $include);

        return view('room/edit')->with(compact('data'));
    }

    public function indexView()
    {
        $include = [

        ];

        $data = $this->roomServices->index($include);

        return view('room/index')->with(compact('data'));
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
