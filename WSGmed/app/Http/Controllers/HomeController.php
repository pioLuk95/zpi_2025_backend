<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;
use App\Models\EmergencyCalls;
use App\Models\Staff;

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

        $medications = Medication::latest()->take(5)->get();
        $calls = EmergencyCalls::latest()->take(8)->get();
        $staff = Staff::latest()->take(6)->get();

        return view('home', compact('medications', 'calls', 'staff'));
    }
}
