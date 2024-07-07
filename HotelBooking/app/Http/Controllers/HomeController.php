<?php

namespace App\Http\Controllers;

use App\Models\Apartment\Apartment;
use App\Models\Hotel\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        2 cach lay du lieu
//        $hotel = Hotel::query()->select()->orderBy('id','desc')->take(3)->get();
        $room = Apartment::query()->select()->orderBy('id','desc')->take(4)->get();
        $hotel = Hotel::select()->orderBy('id','desc')->take(3)->get();
        return view('home',compact('hotel','room'));
    }
}
