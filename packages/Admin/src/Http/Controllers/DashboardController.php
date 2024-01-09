<?php

namespace Admin\Http\Controllers;

use Admin\Http\Resources\DashboardResource;
use App\Constants\StatusCode;
use App\Foundations\Dashboard\DashboardCollection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = DashboardCollection::dashboardData();

        return response()->success(
            trans('dashboard.dashboard_retrieved_successfully'),
            new DashboardResource($data),
            StatusCode::OK
        );
    }
}
