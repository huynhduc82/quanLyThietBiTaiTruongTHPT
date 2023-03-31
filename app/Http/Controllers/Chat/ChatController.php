<?php

namespace App\Http\Controllers\Chat;

use App\Events\MessageSend;
use App\Http\Controllers\Controller;
use App\Services\Chat\ChatServices;
use App\Services\User\UserProfileService;
use App\Transformers\Chat\ChatTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct(
        protected ChatServices $chatServices,
        protected UserProfileService $userProfileService,
    )
    {
    }

    public function indexView()
    {
        $include = [
            'user',
            'user.avatarInfo'
        ];
        $limit = 20;
        $data = $this->chatServices->index($include, $limit);
        $user = $this->userProfileService->index();
        return view('chat/index')->with(compact(['data','user']));
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
        $include = [
            'user',
            'user.avatarInfo'
        ];
        $result->loadMissing($include);

        broadcast(new MessageSend($result))->toOthers();

        return $this->response($this->transform($result, ChatTransformer::class, $include));
    }
}
