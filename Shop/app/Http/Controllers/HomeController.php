<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoty;
use App\Models\Goods;

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
        $catagory = Categoty::get();
        $goods = Goods::get();



        //dd($data->toArray()[0]);
        //dd($goods->toArray());
        return view('home');
    }
}
