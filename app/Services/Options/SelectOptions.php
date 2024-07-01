<?php

namespace App\Services\Options;

class SelectOptions
{
    public static array $contraceptives = [
        'coc' => 'COC',
        'pop' => 'POP',
        'depo' => 'Depo',
        'implants' => 'Implants',
        'iud' => 'IUD',
        'condoms' => 'Condoms',
        'diaphragm' => 'Diaphragm',
        'vasectomy' => 'Vasectomy',
        'tubal_ligation' => 'Tubal Ligation',
        'lam' => 'LAM',
        'withdrawl' => 'Withdrawl',
        'natural_family_planning' => 'Natural Family Planning',
    ];

    public static array $ancTimings = [
        '1st_lt14' => '1st Visit - <14 wk',
        '2nd_15-28' => '2nd Visit - 15 to 28 wk',
        '3rd_29-34' => '3rd Visit - 29 to 34 wk',
        '4th_gtequal35' => '4th Visit - >= 35 wk',
    ];

    public static array $abdExams = [
        'uterine_size' => 'သားအိမ်အရွယ်အစားကိုကြည့်၍ ကိုယ်ဝန်သက်တမ်းကိုသတ်မှတ်ပါ',
        'fetus_count' => 'သန္ဓေသား အရေအတွက်ကို စမ်းသပ်ပါ',
        'sfheight' => 'symphysis-fundus အမြင့်ကိုတိုင်းတာပါ',
        'fetal_lie_presentation' => 'သန္ဓေသား၏ lie နှင့် presentation ကိုအကဲဖြတ်ပါ',
        'liquor_amount' => 'ရေမြွှာရည်ပမာဏကိုအကဲဖြတ်ပါ',
        'fetal_heart_sound' => 'သန္ဓေသားနှလုံးခုန်သံကိုနားထောင်ပါ',
        'fetal_movement' => 'သန္ဓေသားလှုပ်ရှားမှုများကိုစစ်ဆေးပါ',
    ];

    public static array $aphCauses = [
        'abruptio_placenta' => 'အချင်းစောကွာခြင်း',
        'placenta_previa' => 'အချင်းရှေ့ရောက်ခြင်း',
        'uterine_rupture' => 'သားအိမ်ကွဲခြင်း',
        'still_birth' => 'ကလေးအသေမွေးခြင်း',
        'cervical_trauma' => 'သားအိမ်ခေါင်းဒဏ်ရာရခြင်း',
    ];

    public static array $thirdStageSteps = [
        'uterine_stimulant' => 'သားအိမ်လှုံ့ဆော်သောဆေးပေးခြင်း',
        'cord_clamp' => '၁ မိနစ်မှ ၃ မိနစ်အတွင်း ချက်ကြိုးအား clamp လုပ်ခြင်း',
        'cct' => 'သားအိမ်ကိုလက်တဖက်ဖြင့် ပင့်တင်၍ ချက်ကြိုးကို ထိန်း၍ အချင်း ဆွဲထုတ်ခြင်း  (Controlled cord traction)',
        'placenta_delivery' => 'အချင်းမွေးဖွားခြင်း ပြည့်စုံမှု ရှိမရှိ စစ်ဆေးခြင်း',
        'fundal_message' => 'သားအိမ်ကိုနှိပ်နယ်ပေးခြင်း (Massage of the uterine fundus)',
        'one_hour_monitor' => 'အကယ်၍ အချင်းမကွာပါက အချင်းကွာမချင်း ၁ နာရီအထိ စောင့်ကြည့်ခြင်း',
    ];

    public static array $pphCauses = [
        'uterine_atony' => 'သားအိမ်ပြန်မကျုံ့နိုင်ခြင်း (Uterine atony)',
        'trauma' => 'သားအိမ်ဒဏ်ရာရခြင်း (Trauma/ intra-abdominal injury)',
        'retained_placenta' => 'အချင်းကျန်ခြင်း သို့မဟုတ် အချင်းမူမမှန်ဖြစ်ခြင်း (Retained placenta or placental abnormalities)',
        'coagulopathy' => 'Coagulopathy',
    ];

    public static array $pncTimings = [
        'within_24hr' => 'ပထမအကြိမ် >> မွေးဖွားပြီး ၂၄ နာရီအတွင်း (အိမ်တွင် သို့မဟုတ် ဆေးခန်းတွင်)',
        '2-7days' => 'ဒုတိယအကြိမ် >> မွေးဖွားပြီး ၂ - ၇ ရက် အတွင်း',
        '8-42days' => 'တတိယအကြိမ် >> မွေးဖွားပြီး ၈ - ၄၂ ရက် အတွင်း',
    ];

    public static array $u5mrCauses = [
        'neonatal_mortality' => 'မွေးကင်းစကလေးသေဆုံးမှုဖြစ်စေသော အကြောင်းရင်း ၃ ခုမှာ sepsis and pneumonia, prematurity, birth asphyxia တို့ဖြစ်ပါသည်',
        'u5_mortality' => '၅ နှစ်အောက်ကလေးသေဆုံးမှုဖြစ်စေသော အကြောင်းရင်း ၂ ခုမှာ pneumonia, diarrhoea ဖြစ်ပါသည်',
    ];
}
