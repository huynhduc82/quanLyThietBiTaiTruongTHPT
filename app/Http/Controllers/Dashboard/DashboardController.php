<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    )
    {
    }

    public function indexView()
    {
        $data = $this->dashboardService->index();
        return view('dashboard/index')->with(compact('data'));
    }

    public function static($start, $end)
    {
        $result = $this->dashboardService->static($start, $end);
        return $this->response($result);
    }

    public function roleView()
    {
        $data = $this->dashboardService->getRoleData();
        return view('role/index')->with(compact('data'));
    }

    public function roleEditView($id)
    {
        $data = $this->dashboardService->getRoleDataByUser($id);
        return view('role/edit')->with(compact('data'));
    }

    public function assRole(Request $request, $id)
    {
        $input = $request->all();

        $this->dashboardService->assRole($id, $input);

        return $this->response('OK');
    }
}
