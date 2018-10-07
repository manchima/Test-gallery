<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picdatas;

class PicdataController extends Controller
{
    //
    public function index()
    {
        $data = Picdatas::all();
        return $data;
    }
}
