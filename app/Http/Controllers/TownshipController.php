<?php

namespace App\Http\Controllers;

use App\Models\Township;
use Illuminate\Http\Request;

class TownshipController extends Controller
{
    public function index()
    {
        // Admin ဘက်မှာ စာမျက်နှာအလိုက် ၄ ခုစီ ခွဲပြမယ်
        $townships = Township::paginate(4);

        return view('admin.townships.index', compact('townships'));
    }

    public function create()
    {
        return view('admin.townships.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Township::create($request->only('name'));

        return redirect()->route('admin.townships.index')->with('success', 'Division created successfully.');
    }
}
