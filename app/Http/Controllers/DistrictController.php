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
    public function index(Request $request)
    {
        // ခရိုင်နဲ့ တိုင်းဒေသကြီး တွဲလျက်ဆွဲထုတ်မယ်
        $query = District::with('division');

        // ၁။ ခရိုင်အမည် ရိုက်ရှာထားတာရှိရင်
        if ($request->has('search') && ! empty($request->search)) {
            $searchTerm = $request->search;
            $query->where('name', 'LIKE', '%'.$searchTerm.'%');
        }

        // ၂။ Dropdown ကနေ တိုင်း/ပြည်နယ်အလိုက် Filter လုပ်ထားရင်
        if ($request->filled('division_id')) {
            $query->where('division_id', $request->division_id);
        }

        // URL parameter တွေပါသယ်ပြီး စာမျက်နှာခွဲထုတ်မယ်
        $districts = $query->paginate(10)->appends($request->query());

        // Dropdown ထဲမှာပြဖို့ တိုင်း/ပြည်နယ် အားလုံးကိုဆွဲထုတ်မယ်
        $divisions = Division::all();

        return view('admin.districts.index', compact('districts', 'divisions'));
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
