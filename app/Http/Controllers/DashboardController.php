<?php

namespace App\Http\Controllers;

use App\Foundations\Dashboard\DashboardCollection;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $data = DashboardCollection::dashboardData();

        return view('Admin/dashboard', $data);
    }
}
