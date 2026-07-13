<?php

namespace App\Http\Controllers;

use App\Models\Division;   // 💡 တိုးလာသော Model များကိုလည်း တစ်ပါတည်း Import လုပ်ထားပေးပါသည်
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $today = Carbon::today();

        // 1. Users & New Registrations Today
        $userCount = User::count();
        $newUsersToday = User::where('created_at', '>=', $today)->count();

        // 2. Divisions (အပေါ်က Dashboard Layout မှာ ပါဝင်သောကြောင့် ထည့်သွင်းပေးထားပါသည်)
        $activeDivisionsCount = Division::count();
        $newDivisionsThisMonth = Division::where('created_at', '>=', $startOfMonth)->count();

        // 💡 ပြီးမှ view ကို ခေါ်ပြီး compact() ဖြင့် Variable အားလုံးကို ယူဆောင်သွားပါသည်
        return view('admin.dashboard', compact(
            'userCount',
            'newUsersToday',
            'activeDivisionsCount',
            'newDivisionsThisMonth',

        ));
    }
}
