<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\TaskRepository;
use App\Repositories\SaleRepository;
use Twitter;
use Facebook;

class DashboardController extends Controller
{

    public function index(Request $request)
    {

        return view('dashboard.dashboard');

    }
}
