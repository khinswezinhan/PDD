<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * 🌟 မူရင်း Home Page (User View) အတွက်
     */
    public function index()
    {
        // Home Page မှာ Pagination မလိုဘဲ အကုန်ပြချင်ရင် All() သုံးပါ (သို့မဟုတ်) Paginate(4) သုံးနိုင်ပါတယ်
        $divisions = Division::all(); 

        return view('home', compact('divisions'));
    }

    /**
     * 🌟 Admin Panel က တိုင်းဒေသကြီး List ပြခန်းအတွက် (Function အသစ်ခွဲလိုက်ပါသည်)
     */
    public function adminIndex()
    {
        // Admin ဘက်မှာ စာမျက်နှာအလိုက် ၄ ခုစီ ခွဲပြမယ်
        $divisions = Division::paginate(4);

        return view('admin.divisions.index', compact('divisions'));
    }

    public function create()
    {
        return view('admin.divisions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Division::create($request->only('name'));

        return redirect()->route('admin.divisions.index')->with('success', 'Division created successfully.');
    }
}