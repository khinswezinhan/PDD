<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Pagoda;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * ပင်မစာမျက်နှာ (Home Page) အတွက် ဒေတာထုတ်ပေးခြင်း
     */
    public function index()
    {
        $divisions = Division::paginate(4);

        $famousPagodas = Pagoda::with('township.district.division')
                            ->where('status', 'famous')
                            ->get();

        return view('home', compact('divisions', 'famousPagodas'));
    }

    /**
     * တိုင်းဒေသကြီးအလိုက် ဘုရားများပြသခြင်း
     */
    public function showDivision($id)
    {
        $division = Division::findOrFail($id);

        $pagodas = Pagoda::whereHas('township.district.division', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();

        return view('divisionState', compact('division', 'pagodas'));
    }

    /**
     * 🌟 ဤနေရာတွင် အသစ်တိုးလိုက်ပါသည်
     * ဘုရားတစ်ဆူချင်းစီ၏ အသေးစိတ် (Detail) ကို ပြသရန် Function
     */
    public function showPagoda($id)
    {
        // ၁။ URL က ပါလာတဲ့ ဘုရား ID ကို Database ထဲမှာ ရှာဖွေသည်
        // (Relationship ပါးစပ် ချိတ်ဆက်ပြီးသား ပါအောင် township အထိပါ ဆွဲတင်ထားပါမယ်)
        $pagoda = Pagoda::with('township.district.division')->findOrFail($id);

        // ၂။ ရှာတွေ့တဲ့ ဘုရား data ကို pagoda-detail (သို့မဟုတ် အစ်ကို့ရဲ့ detail ဖိုင်အမည်) ဆီသို့ ပို့ပေးခြင်း
        return view('pagodaDetail', compact('pagoda'));
    }
}