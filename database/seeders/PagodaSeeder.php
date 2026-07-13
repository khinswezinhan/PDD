<?php

namespace Database\Seeders;

use App\Models\Pagoda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PagodaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $townships = [
            ['name' => 'ရွှေမော်ဓောစေတီတော်', 'township_id' => 5,'photo'=>'images/ရွှေမော်ဓောစေတီတော်.jpg','map_link'=>'<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3808.556397099817!2d96.49205117132843!3d17.336939667905977!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c3d0d240ebc867%3A0x783d47ae502b939!2z4YCb4YC94YC-4YCx4YCZ4YCx4YCs4YC64YCT4YCx4YCs4YCF4YCx4YCQ4YCu4YCQ4YCx4YCs4YC64YCZ4YC84YCQ4YC64YCA4YC84YCu4YC4!5e0!3m2!1smy!2smm!4v1702112692783!5m2!1smy!2smm" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></if','website'=>'http://bagoshwemawdaw.com.mm/','address'=>'ပဲခူးလမ်း၊ ပဲခူးမြို့','history'=>' ရွှေမော်ဓေါဘုရားကြီ:ကို ပဲခူးမြို့၏အပြင်ဘက် (၆) မိုင်ခန့်အကွာမှစ၍ ထင်ရှားစွာဖူးမြှော်တွေ့ရှိနိုင်သည်။ ဘုရားရှင် သက်တော်ထင်ရှားရှိစဉ်အချိန်တွင် မဟာသာလ၊ စူဠာသာလ ကုန်သည်ညီနောင်(၂) ဦးအား ဆံတော်(၂)ဆူပေးအပ်ခဲ့သည်။ ထိုကုန်သည်ညီနောင်(၂) ဦးတို့သည် ဆံတော်(၂)ဆူအား ပင့်ခဲ့ပြီးနောက် ပဲခူး သုဒဿန တောင်ထိပ်တွင် (၇၅) ပေမြင့်သော စေတီကိုတည်၍ ဆံတော်(၂)ဆူ ဌာပနာခဲ့သည်။ အေဒီ(၈၂၅-၈၄၀) သမလဘုရင် လက်ထက်တွင် စေတီတော်အမြင့်ကို (၈၁) ပေနှင့် ဝိမလဘုရင် လက်ထက်တွင် (၈၈)ပေ အသီးသီးပြန်တည်ခဲ့သည်။
','status'=>'famous'],
            
        ];

        Pagoda::insert($townships);
    }
}
