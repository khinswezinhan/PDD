<?php

namespace App\Http\Controllers;

use App\Models\Pagoda;
use Illuminate\Http\Request;

class PagodaController extends Controller
{
     public function index()
    {
        // Admin ဘက်မှာ စာမျက်နှာအလိုက် ၄ ခုစီ ခွဲပြမယ်
        $pagodas = Pagoda::paginate(4);

        return view('admin.pagodas.index', compact('pagodas'));
    }

    public function create()
    {
        return view('admin.pagodas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Pagoda::create($request->only('name'));

        return redirect()->route('admin.pagodas.index')->with('success', 'Division created successfully.');
    }
}
