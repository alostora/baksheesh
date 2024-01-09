<?php

namespace Client\Http\Controllers;

use App\Constants\StatusCode;
use App\Foundations\Dashboard\DashboardClientCollection;
use App\Http\Controllers\Controller;
use Client\Http\Resources\DashboardClientResource;

class DashboardClientController extends Controller
{
    public function index()
    {
        $data = DashboardClientCollection::dashboardData();

        return response()->success(
            trans('dashboard.dashboard_retrieved_successfully'),
            new DashboardClientResource($data),
            StatusCode::OK
        );
    }
}
