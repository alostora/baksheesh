<?php

namespace App\Http\Controllers;

use App\Foundations\Dashboard\DashboardClientCollection;
use App\Foundations\Dashboard\DashboardCollection;
use Illuminate\Http\Request;

class DashboardClientController extends Controller
{
    public function index()
    {

        $data = DashboardClientCollection::dashboardData();

        return view('Client/dashboard', $data);
    }
}
