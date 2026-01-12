<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $nip = session('nip');

        return view('admin.index', compact('nip'));
    }

}
