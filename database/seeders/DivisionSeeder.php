<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder; // 💡 သင်၏ Division Model ကို ခေါ်ယူရန်မမေ့ပါနှင့်

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // တိုင်းဒေသကြီးနှင့် ပြည်နယ်များစာရင်း Array
        $divisions = [
            ['name' => 'မန္တလေးတိုင်းဒေသကြီး', 'photo' => 'images/divisions/mandalay.jpg'],
            ['name' => 'ရန်ကုန်တိုင်းဒေသကြီး', 'photo' => 'images/divisions/yangon.jpg'],
            ['name' => 'ပဲခူးတိုင်းဒေသကြီး', 'photo' => 'images/divisions/bago.jpg'],
            ['name' => 'ဧရာဝတီတိုင်းဒေသကြီး', 'photo' => 'images/divisions/ayeyarwady.jpg'],
            ['name' => 'စစ်ကိုင်းတိုင်းဒေသကြီး', 'photo' => 'images/divisions/sagaing.jpg'],
            ['name' => 'မကွေးတိုင်းဒေသကြီး', 'photo' => 'images/divisions/magway.jpg'],
            ['name' => 'တနင်္သာရီတိုင်းဒေသကြီး', 'photo' => 'images/divisions/tanintharyi.jpg'],
            ['name' => 'ကချင်ပြည်နယ်', 'photo' => 'images/divisions/kachin.jpg'],
            ['name' => 'ကယားပြည်နယ်', 'photo' => 'images/divisions/kayar.jpg'],
            ['name' => 'ကရင်ပြည်နယ်', 'photo' => 'images/divisions/kayin.jpg'],
            ['name' => 'ချင်းပြည်နယ်', 'photo' => 'images/divisions/chin.jpg'],
            ['name' => 'မွန်ပြည်နယ်', 'photo' => 'images/divisions/mon.jpg'],
            ['name' => 'ရခိုင်ပြည်နယ်', 'photo' => 'images/divisions/rakhine.jpg'],
            ['name' => 'ရှမ်းပြည်နယ်', 'photo' => 'images/divisions/shan.jpg'],
            ['name' => 'နေပြည်တော်ကောင်စီနယ်မြေ', 'photo' => 'images/divisions/uppatasanti.jpg'],
        ];

        // Database ထဲသို့ တစ်ခုချင်းစီ ပတ်၍ ထည့်သွင်းခြင်း
        foreach ($divisions as $division) {
            Division::create($division);
        }
    }
}
