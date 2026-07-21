<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Pagoda;
use App\Models\Township;
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
    public function showDivision(int $id)
    {
        $division = Division::findOrFail($id);
        if($division)
        {
            $pagodas = Pagoda::whereHas('township.district', function($q)  use($id) {
                $q->where('division_id', $id);
            })->get(); 
        }
       $data =[
        'division'=>$division,
        'pagodas'=> $pagodas
       ];
        return view('divisionState', $data);
    }

    /**
     * ဘုရားတစ်ဆူချင်းစီ၏ အသေးစိတ် (Detail) ကို ပြသရန် Function
     */
    public function showPagoda(int $id)
    {
        $pagoda = Pagoda::with('township.district.division')->findOrFail($id);
        return view('pagodaDetail', compact('pagoda'));
    }
}