<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * 🌟 Admin Panel က တိုင်းဒေသကြီး List ပြခန်းအတွက် (Function အသစ်ခွဲလိုက်ပါသည်)
     */
    public function index()
    {
        // Admin ဘက်မှာ စာမျက်နှာအလိုက် ၄ ခုစီ ခွဲပြမယ်
        $districts = District::paginate(4);

        return view('admin.districts.index', compact('districts'));
    }

    public function create()
    {
        $divisions = Division::all();

        return view('admin.districts.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
        ]);

        District::create($request->only('name', 'division_id'));

        return redirect()->route('admin.districts.index')->with('success', 'District created successfully.');
    }

    public function edit(District $district)
    {
        $divisions = Division::all();

        return view('admin.districts.edit', compact('district', 'divisions'));
    }

    public function update(Request $request, District $district)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
        ]);

        $district->update($request->only('name', 'division_id'));

        return redirect()->route('admin.districts.index')->with('success', 'District updated successfully.');
    }
}
