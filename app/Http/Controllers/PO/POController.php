<?php

namespace App\Http\Controllers\PO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class POController extends Controller
{
    public function addAsset()
    {
        return view('PO.add-asset');
    }
}
