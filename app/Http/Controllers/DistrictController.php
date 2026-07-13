<?php

namespace App\Http\Controllers;

use App\Models\District;
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
        return view('admin.districts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        District::create($request->only('name'));

        return redirect()->route('admin.districts.index')->with('success', 'Division created successfully.');
    }
}
