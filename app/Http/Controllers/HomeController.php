<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picdatas;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getOverview(){
        $size = Picdatas::all()->sum('image_size');
        $count = Picdatas::all()->count();

        $size = $size/1024;
        $row = [
            'size'=>$size,
            'total'=> $count
        ];
        $data = ['row'=>$row];
        return $data;
    }

    public function getDetail(){
        $data = Picdatas::groupBy('type')
                ->selectRaw('type', 'count(1) as total', 'sum(image_size) as size')
                ->get();
        return $data;
    }
}
