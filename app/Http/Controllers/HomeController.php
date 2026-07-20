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
        $divisions = Division::paginate(4, ['*'], 'division_page');

        $famousPagodas = Pagoda::with('township.district.division')
                    ->where('status', 'famous')
                    ->paginate(4, ['*'], 'famous_page');

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
     * ဘုရားတစ်ဆူချင်းစီ၏ အသေးစိတ် (Detail) ကို ပြသရန် Function
     */
    public function showPagoda($id)
    {
        $pagoda = Pagoda::with('township.district.division')->findOrFail($id);
        return view('pagodaDetail', compact('pagoda'));
    }
}