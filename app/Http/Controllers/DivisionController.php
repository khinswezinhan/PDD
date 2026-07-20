<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    // public function index()
    // {
    //     // Home Page မှာ Pagination မလိုဘဲ အကုန်ပြချင်ရင် All() သုံးပါ (သို့မဟုတ်) Paginate(4) သုံးနိုင်ပါတယ်
    //     $divisions = Division::all();

    //     return view('home', compact('divisions'));
    // }

    public function index(Request $request)
    {
        // Query စတင်တည်ဆောက်မယ်
        $query = Division::query();

        // ၁။ ရှာဖွေရေး box ထဲမှာ စာရိုက်ရှာထားရင် (ဥပမာ - ရန်ကုန်၊ မန္တလေး)
        if ($request->has('search') && ! empty($request->search)) {
            $searchTerm = $request->search;
            $query->where('name', 'LIKE', '%'.$searchTerm.'%');
        }

        // ၂။ တကယ်လို့ Division ID အလိုက် Filter လုပ်ချင်ရင် (Dropdown အတွက်)
        if ($request->filled('division_id')) {
            $query->where('id', $request->division_id);
        }

        // စာမျက်နှာအလိုက် Pagination တွက်ပြီး URL parameters တွေပါ တွဲသယ်သွားမယ်
        $divisions = $query->paginate(5)->appends($request->query());

        // Dropdown ထဲမှာ ပြန်ပြဖို့အတွက် Divisions အားလုံးကို ဆွဲထုတ်မယ်
        $all_divisions = Division::all();

        return view('admin.divisions.index', compact('divisions', 'all_divisions'));
    }

    public function create()
    {
        return view('admin.divisions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $division = new Division;
        $division->name = $request->name;

        // 💡 ပုံသိမ်းဆည်းမှုကို public/images/divisions/ ထဲ တိုက်ရိုက်ဝင်အောင် ပြင်ဆင်ထားပါသည်
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time().'_'.$image->getClientOriginalName();

            // public/images/ ထဲသို့ ဖိုင်ရွှေ့ခြင်း
            $image->move(public_path('images/'), $imageName);

            // DB ထဲသို့ လမ်းကြောင်းသိမ်းခြင်း
            $division->photo = 'images/'.$imageName;
        }

        $division->save();

        return redirect()->route('admin.divisions.index')->with('success', 'Division created successfully.');
    }

    public function edit(Division $division)
    {
        return view('admin.divisions.edit', compact('division'));
    }

    public function update(Request $request, Division $division)
    {
        // ၁။ Validation စစ်ဆေးခြင်း
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // ၂။ ပြင်ဆင်မည့် ဒေတာများကို တိုက်ရိုက် Assign လုပ်ခြင်း
        $division->name = $request->name;

        // ၃။ ပုံအသစ်ပါလာလျှင် public folder ထဲက ပုံဟောင်းကို ဖျက်ပြီး အသစ်လဲလှယ်ခြင်း
        if ($request->hasFile('photo')) {
            // ပုံဟောင်းရှိခဲ့လျှင် public folder ထဲကနေ ရှာဖျက်ပါသည်
            if ($division->photo && file_exists(public_path($division->photo))) {
                unlink(public_path($division->photo));
            }

            $image = $request->file('photo');
            $imageName = time().'_'.$image->getClientOriginalName();

            // public folder အသစ်ထဲသို့ တိုက်ရိုက်ရွှေ့ပါသည်
            $image->move(public_path('images'), $imageName);

            $division->photo = 'images/'.$imageName;
        }

        // ၄။ Database ထဲသို့ တိုက်ရိုက် သိမ်းဆည်းခြင်း
        $division->save();

        // နဂိုရောက်နေသည့် Pagination စာမျက်နှာတွင်ပဲ ငြိမ်ပြီး ကျန်ခဲ့စေရန် redirect()->back() သုံးထားပါသည်
        return redirect()->back()->with('success', 'Division updated successfully.');
    }
}
