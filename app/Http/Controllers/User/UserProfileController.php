<?php

namespace App\Http\Controllers\User;

use App\Helpers;
use App\Http\Controllers\Controller;
use App\Services\User\UserProfileService;
use App\Transformers\User\UserProfileTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;


class UserProfileController extends Controller
{
    public function __construct(
        protected UserProfileService $userProfileService
    )
    {
    }

    public function addCourse(Request $request)
    {
        $input = $request::all();

        $this->userProfileService->addCourse($input);
    }

    public function indexView()
    {
        $include=[
            'courses',
            'avatarInfo',
        ];

        $data = $this->userProfileService->details(Helpers::getUserLoginId(),$include);

        return view('profile/index')->with(compact('data'));
    }

    public function details($id): JsonResponse
    {
        $include=[
            'courses',
            'avatarInfo',
        ];

        $result = $this->userProfileService->details($id, $include);

        return $this->response($this->transform($result, UserProfileTransformer::class, $include));
    }

    public function edit(Request $request, $id): JsonResponse
    {
        $input = $request::all();

        $result = $this->userProfileService->edit($input, $id);

        return $this->response($result);
    }

    public function delete($id): JsonResponse
    {
        $result = $this->userProfileService->delete($id);

        return $this->response($result);
    }
}
