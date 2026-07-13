<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        // ရှေ့လည်းမရောက်၊ နောက်လည်းမရောက်ဘဲ မူလနေရာမှာပဲ ငြိမ်နေစေရန် ID အလိုက် စီထားပါသည်
        $divisions = Division::orderBy('id', 'asc')->paginate(4);

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
