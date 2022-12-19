<?php

namespace App\Http\Controllers\User;

use App\Helpers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Equipment\EquipmentService;
use App\Services\User\UserProfileService;
use App\Transformers\Equipment\EquipmentTransformers;
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
            'courses'
        ];

        $data = $this->userProfileService->details(Helpers::getUserLoginId(),$include);

        return view('profile/index')->with(compact('data'));
    }

    public function details($id): JsonResponse
    {
        $include=[
            'status',
            'room'
        ];

        $result = $this->userProfileService->details($id, $include);

        return $this->response($this->transform($result, EquipmentTransformers::class, $include));
    }

    public function store(Request $request)
    {
        $input = $request::all();

        $result = $this->userProfileService->store($input);

        return $result;
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
