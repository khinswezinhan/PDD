<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Pagoda;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    $divisions = Division::all(); 

    $famousPagodas = Pagoda::with('township.district.division')
                            ->where('status', 'famous')
                            ->get();

    return view('home', compact('divisions', 'famousPagodas'));
}
}
