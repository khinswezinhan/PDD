<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Pagoda;
use App\Models\Township;
use Illuminate\Http\Request;

class PagodaController extends Controller
{
    public function index(Request $request)
    {
        // Relationship တွေကို ကြိုဆွဲတင်ထားမယ်
        $query = Pagoda::with(['township.district.division']);

        // ၁။ စေတီပုထိုးအမည် ဖြင့် ရှေ့ရောနောက်ရော ရှာဖွေခြင်း
        if ($request->filled('search_pagoda')) {
            $query->where('name', 'LIKE', '%'.trim($request->search_pagoda).'%');
        }

        // ၂။ မြို့နယ်အမည် ဖြင့် ရှာဖွေခြင်း (ကြားခံ township model ထဲဝင်စစ်ပါတယ်)
        if ($request->filled('search_township')) {
            $searchTownship = trim($request->search_township);
            $query->whereHas('township', function ($q) use ($searchTownship) {
                $q->where('name', 'LIKE', '%'.$searchTownship.'%');
            });
        }

        // ၃။ တိုင်းဒေသကြီး Dropdown ဖြင့် စစ်ထုတ်ခြင်း (ကြားခံ ၃ ဆင့် ဖြတ်စစ်ပါတယ်)
        if ($request->filled('division_id')) {
            $divisionId = $request->division_id;
            $query->whereHas('township.district.division', function ($q) use ($divisionId) {
                $q->where('id', $divisionId);
            });
        }

        // စာမျက်နှာခွဲခြင်း (Pagination) နဲ့ တန်ဖိုးတွေ URL မှာ ကပ်ပါသွားအောင် လုပ်ခြင်း
        $pagodas = $query->paginate(10)->appends($request->query());

        // Dropdown ထဲပြဖို့ Division List ကို ဆွဲထုတ်ခြင်း
        $divisions = Division::all(); // သင့် Division Model path အတိုင်း ပြင်ပေးပါ
        
        return view('admin.pagodas.index', compact('pagodas', 'divisions'));
    }

    public function create()
    {
        // Create form စတင်ပွင့်ချိန်တွင် တိုင်းဒေသကြီး/ပြည်နယ် dropdown ဆွဲတင်နိုင်ရန် ဒေတာလှမ်းပို့ပေးရပါမည်
        $divisions = Division::all();

        return view('admin.pagodas.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        // ၁။ Form မတင်မီ ဝင်လာသော data များကို သေချာစွာ စစ်ဆေးခြင်း (Validation)
        $request->validate([
            'name' => 'required|string|max:255',
            'township_id' => 'required|exists:townships,id',
            'address' => 'required|string',
            'history' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,jfif|max:2048', // ဓာတ်ပုံဖိုင်သတ်မှတ်ချက် 2MB max
            'website' => 'nullable|url',
            'map_link' => 'required|url',
            'status' => 'required|in:famous,normal',
        ]);

        $data = $request->only('name', 'township_id', 'address', 'history', 'website', 'map_link', 'status');

        // ၂။ ဓာတ်ပုံတင်ထားပါက public/uploads/pagodas လမ်းကြောင်းထဲသို့ သိမ်းဆည်းခြင
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'_'.$file->getClientOriginalName();

            // folder မရှိပါက ဆောက်ပြီး သိမ်းဆည်းမည်
            $file->move(public_path('uploads/pagodas'), $filename);

            // Database ထဲ၌ လမ်းကြောင်းအား path အနေဖြင့် သိမ်းဆည်းရန်
            $data['photo'] = 'uploads/pagodas/'.$filename;
        }

        // ၃။ Database ထဲသို့ ဒေတာအသစ် ထည့်သွင်းခြင်း
        Pagoda::create($data);

        return redirect()
            ->route('admin.pagodas.index')
            ->with('success', 'ဘုရားစေတီပုထိုးတော်အချက်အလက်အသစ်အား အောင်မြင်စွာ ထည့်သွင်းသိမ်းဆည်းပြီးပါပြီ။');
    }

    public function edit(Pagoda $pagoda)
    {
        // Edit page တွင် လက်ရှိရွေးထားသော တိုင်းဒေသကြီး၊ ခရိုင်၊ မြို့နယ် ဒေတာများ အလိုအလျောက် Select ဖြစ်နေစေရန်
        $divisions = Division::all();

        $currentTownship = $pagoda->township;
        $currentDistrict = $currentTownship->district ?? null;
        $currentDivisionId = $currentDistrict->division_id ?? null;

        // ဆက်စပ်နေသော ဒေတာများကိုသာ Select Dropdown တွင် သွားရောက်ပြသနိုင်ရန် စစ်ထုတ်ခြင်း
        $districts = $currentDivisionId ? District::where('division_id', $currentDivisionId)->get() : collect();
        $townships = $currentDistrict ? Township::where('district_id', $currentDistrict->id)->get() : collect();

        return view('admin.pagodas.edit', compact('pagoda', 'divisions', 'districts', 'townships'));
    }

    public function update(Request $request, Pagoda $pagoda)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'township_id' => 'required|exists:townships,id',
            'address' => 'required|string',
            'history' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website' => 'nullable|url',
            'map_link' => 'nullable|url',
            'status' => 'required|in:famous,normal',
        ]);

        $data = $request->only('name', 'township_id', 'address', 'history', 'website', 'map_link', 'status');

        // ပုံရိပ်အသစ် ထပ်မံတင်သွင်းပါက ပုံဟောင်းအား ဖြုတ်ပြီး အသစ်ဖြင့် လဲလှယ်ခြင
        if ($request->hasFile('photo')) {
            if ($pagoda->photo && file_exists(public_path($pagoda->photo))) {
                @unlink(public_path($pagoda->photo));
            }

            $file = $request->file('photo');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/pagodas'), $filename);
            $data['photo'] = 'uploads/pagodas/'.$filename;
        }

        $pagoda->update($data);

        return redirect()
            ->route('admin.pagodas.index')
            ->with('success', 'ဘုရားစေတီပုထိုးတော်အချက်အလက်အား အောင်မြင်စွာ ပြင်ဆင်ပြီးပါပြီ။');
    }

    public function getTownshipsByDistrict($districtId)
    {
        // AJAX Request များအတွက် ခရိုင် ID အလိုက် သက်ဆိုင်ရာ မြို့နယ်စာရင်းအား JSON Response ပြန်ပေးခြင်း
        $townships = Township::where('district_id', $districtId)->get(['id', 'name']);

        return response()->json($townships);
    }
}
