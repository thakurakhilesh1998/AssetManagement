<?php

namespace App\Http\Controllers\Meeting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function create()
    {
        return view("DPO/Meeting/create");
    }
}
