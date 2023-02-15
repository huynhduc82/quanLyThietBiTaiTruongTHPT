<?php

namespace App\Http\Controllers\Recoup;

use App\Http\Controllers\Controller;
use App\Services\Recoup\RecoupService;
use App\Transformers\Recoup\RecoupTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class RecoupController extends Controller
{
    public function __construct(
        protected RecoupService $RecoupService
    )
    {
    }
    public function indexView()
    {
        $include = [
        ];

        $data = $this->RecoupService->index($include);

        return view('compensation/index')->with(compact('data'));
    }

    public function index()
    {
        $include = [
        ];

        $result = $this->RecoupService->index($include);

        return $this->transform($result, RecoupTransformer::class, $include);
    }

    public function details($id): JsonResponse
    {
        $include = [
        ];

        $result = $this->RecoupService->details($id, $include);

        return $this->response($this->transform($result, RecoupTransformer::class, $include));
    }

}
