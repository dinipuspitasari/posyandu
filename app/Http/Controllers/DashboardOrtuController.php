<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAnak;
use App\Models\DataOrangTua;
use App\Models\JadwalPosyandu;
use App\Models\PerkembanganAnak;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class DashboardOrtuController extends Controller
{
    public function index()
    {
         return view('dashboard-ortu');
    }
}


