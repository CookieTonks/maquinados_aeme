<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Notifications\OrderProcessed;

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
        return view('home');
    }

    public function store()
    {
        return view('welcome');
    }

    public function store_dos(Request $request)
    {
        $order=Order::factory()->create();
        
        $request->user()->notify(new OrderProcessed($order));

        return redirect()->route('store')->with('status', 'Order Placed!');
    }
}
