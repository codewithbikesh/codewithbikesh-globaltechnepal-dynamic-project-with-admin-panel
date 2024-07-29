<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Clients;
use App\Models\Contact;
use App\Models\OurTeam;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $teamMemberCount  = OurTeam::count();
        $contactCount = Contact::count();
        $clientCount = Clients::count();
          return view("admin.dashboard",compact("teamMemberCount","contactCount","clientCount"));
    }
}

