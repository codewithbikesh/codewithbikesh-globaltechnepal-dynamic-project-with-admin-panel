<?php

namespace App\Http\Controllers;

use App\Models\OurTeam;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('account.dashboard');
   }
}
