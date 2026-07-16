<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Township;
use Illuminate\Http\Request;

class TownshipController extends Controller
{
    public function index()
    {
        // Admin ဘက်မှာ စာမျက်နှာအလိုက် ၄ ခုစီ ခွဲပြမယ်
        $townships = Township::orderBy('id', 'asc')->paginate(4);

        return view('admin.townships.index', compact('townships'));
    }

    public function create()
    {
        $divisions = Division::all();
        $districts = District::all();

        return view('admin.townships.create', compact('divisions', 'districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'district_id' => 'required|exists:districts,id',
        ]);

        Township::create($request->only('name', 'district_id'));

        return redirect()->route('admin.townships.index')->with('success', 'Township created successfully.');
    }

    public function edit(Township $township)
    {
        $divisions = Division::all();
        $districts = District::all();

        return view('admin.townships.edit', compact('township', 'divisions', 'districts'));
    }

    public function update(Request $request, Township $township)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'district_id' => 'required|exists:districts,id',
        ]);

        $township->update($request->only('name', 'district_id'));

        return redirect()->route('admin.townships.index')->with('success', 'Township updated successfully.');
    }

    public function getDistrictsByDivision($divisionId)
    {
        $districts = District::where('division_id', $divisionId)->get(['id', 'name']);

        return response()->json($districts);
    }
}
