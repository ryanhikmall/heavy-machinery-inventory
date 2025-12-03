<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $total_items = \App\Models\Sparepart::count();
    $low_stock = \App\Models\Sparepart::whereColumn('stock', '<=', 'min_stock')->count();
    
    return view('dashboard', compact('total_items', 'low_stock'));
}
}
