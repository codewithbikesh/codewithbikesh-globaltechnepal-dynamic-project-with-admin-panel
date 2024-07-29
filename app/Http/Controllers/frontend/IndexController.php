<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\OurTeam;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $ourteams = OurTeam::count();
         return view("frontend.index",compact("ourteams"));
    }
}
