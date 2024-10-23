<?php

namespace App\Http\Controllers\Meeting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MeetingController extends Controller
{
    public function create()
    {
        $months = [];
        for ($i = 0; $i < 4; $i++) {
            $months[] = Carbon::now()->subMonths($i)->format('F Y');
        }
        return view("DPO/Meeting/create",compact('months'));
    }
}
