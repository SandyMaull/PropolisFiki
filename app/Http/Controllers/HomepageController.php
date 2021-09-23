<?php

namespace App\Http\Controllers;

use App\Data;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalDistri = Data::where('position', 'Distributor')->get()->count();
        $totalAgent = Data::where('position', 'Agent')->get()->count();
        $totalReseller = Data::where('position', 'Reseller')->get()->count();
        $totalCT = Data::where('position', 'CT')->get()->count();
        return view('admin.index', [
            'tot_distri' => $totalDistri, 
            'tot_agent' => $totalAgent, 
            'tot_resel' => $totalReseller, 
            'tot_ct' => $totalCT]);
    }
}
