<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    public function messages_monboncoin()
    {
        $messages = DB::table('messages')->where('seller_id', '=', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        return view('monboncoin.messages', compact('messages'));
    }

    public function my_ads(){

        $total = DB::table('ads')->count();
        $ads = (auth()->user())->ads()->paginate(10);

        return view('monboncoin.my-ads', compact('total','ads'));

    }
}
