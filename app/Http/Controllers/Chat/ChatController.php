<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Services\Chat\ChatServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct(
        protected ChatServices $chatServices
    )
    {
    }

    public function indexView()
    {
        $include = [
            'user',
            'user.avatarInfo'
        ];
        $data = $this->chatServices->index($include);
        return view('chat/index')->with(compact(['data']));
    }

    public function index()
    {
        $include = [
            'user',
            'user.avatarInfo'
        ];
        $data = $this->chatServices->index($include);
        return $this->response($data);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $result = $this->chatServices->store($input);

        return $this->response($result);
    }
}
