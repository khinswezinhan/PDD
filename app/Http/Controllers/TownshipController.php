<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Township;
use Illuminate\Http\Request;

class TownshipController extends Controller
{
    public function index(Request $request)
    {
        // Relationship တွေကို ဆွဲတင်ထားမယ်
        $query = Township::with(['district.division']);

        // ၁။ မြို့နယ်အမည် ရိုက်ရှာလျှင်
        if ($request->filled('search_township')) {
            $query->where('name', 'LIKE', '%'.trim($request->search_township).'%');
        }

        // ၂။ ခရိုင်အမည် ရိုက်ရှာလျှင် (ခရိုင် model ရဲ့ name ကို စစ်တာပါ)
        if ($request->filled('search_district')) {
            $searchDistrict = trim(str_replace('ခရိုင်', '', $request->search_district));
            $query->whereHas('district', function ($q) use ($searchDistrict) {
                $q->where('name', 'LIKE', '%'.$searchDistrict.'%');
            });
        }

        // ၃။ တိုင်းဒေသကြီး/ပြည်နယ် Dropdown ဖြင့် စစ်ထုတ်ခြင်း (ကြားခံ District ရှိတဲ့အတွက် အခုလို စစ်ပါတယ်)
        if ($request->filled('division_id')) {
            $divisionId = $request->division_id;
            $query->whereHas('district.division', function ($q) use ($divisionId) {
                $q->where('id', $divisionId);
            });
        }

        $townships = $query->paginate(4)->appends($request->query());
        $divisions = Division::all();

        return view('admin.townships.index', compact('townships', 'divisions'));
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
