<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('townships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('state_id')->constrained('states')->cascadeOnDelete();
            $table->timestamps();
        });

        DB::table('townships')->insert([
            [
                'name' => 'Bago',
                'state_id' => 1,
            ],
            [
                'name' => 'Thanatpin',
                'state_id' => 1,
            ],
            [
                'name' => 'Kawa',
                'state_id' => 1,
            ],
            [
                'name' => 'Waw',
                'state_id' => 1,
            ],
            [
                'name' => 'Nyaunglebin',
                'state_id' => 1,
            ],
            [
                'name' => 'Kyauktaga',
                'state_id' => 1,
            ],
            [
                'name' => 'Daik-U',
                'state_id' => 1,
            ],
            [
                'name' => 'Shwegyin',
                'state_id' => 1,
            ],
            [
                'name' => 'Falam',
                'state_id' => 2,
            ],
            [
                'name' => 'Hakha',
                'state_id' => 2,
            ],
            [
                'name' => 'Thantlang',
                'state_id' => 2,
            ],
            [
                'name' => 'Tedim',
                'state_id' => 2,
            ],
            [
                'name' => 'Tonzang',
                'state_id' => 2,
            ],
            [
                'name' => 'Mindat',
                'state_id' => 2,
            ],
            [
                'name' => 'Matupi',
                'state_id' => 2,
            ],
            [
                'name' => 'Kanpetlet',
                'state_id' => 2,
            ],
            [
                'name' => 'Paletwa',
                'state_id' => 2,
            ],
            [
                'name' => 'Myitkyina',
                'state_id' => 3,
            ],
            [
                'name' => 'Waingmaw',
                'state_id' => 3,
            ],
            [
                'name' => 'Injangyang',
                'state_id' => 3,
            ],
            [
                'name' => 'Tanai',
                'state_id' => 3,
            ],
            [
                'name' => 'Chipwi',
                'state_id' => 3,
            ],
            [
                'name' => 'Tsawlaw',
                'state_id' => 3,
            ],
            [
                'name' => 'Mohnyin',
                'state_id' => 3,
            ],
            [
                'name' => 'Mogaung',
                'state_id' => 3,
            ],
            [
                'name' => 'Hpakant',
                'state_id' => 3,
            ],
            [
                'name' => 'Bhamo',
                'state_id' => 3,
            ],
            [
                'name' => 'Shwegu',
                'state_id' => 3,
            ],
            [
                'name' => 'Momauk',
                'state_id' => 3,
            ],
            [
                'name' => 'Mansi',
                'state_id' => 3,
            ],
            [
                'name' => 'Puta-O',
                'state_id' => 3,
            ],
            [
                'name' => 'Sumprabum',
                'state_id' => 3,
            ],
            [
                'name' => 'Machanbaw',
                'state_id' => 3,
            ],
            [
                'name' => 'Nawngmun',
                'state_id' => 3,
            ],
            [
                'name' => 'Khaunglanhpu',
                'state_id' => 3,
            ],
            [
                'name' => 'Loikaw',
                'state_id' => 4,
            ],
            [
                'name' => 'Demoso',
                'state_id' => 4,
            ],
            [
                'name' => 'Hpruso',
                'state_id' => 4,
            ],
            [
                'name' => 'Shadaw',
                'state_id' => 4,
            ],
            [
                'name' => 'Bawlakhe',
                'state_id' => 4,
            ],
            [
                'name' => 'Hpasawng',
                'state_id' => 4,
            ],
            [
                'name' => 'Mese',
                'state_id' => 4,
            ],
            [
                'name' => 'Hpa-An',
                'state_id' => 5,
            ],
            [
                'name' => 'Hlaingbwe',
                'state_id' => 5,
            ],
            [
                'name' => 'Hpapun',
                'state_id' => 5,
            ],
            [
                'name' => 'Thandaunggyi',
                'state_id' => 5,
            ],
            [
                'name' => 'Myawaddy',
                'state_id' => 5,
            ],
            [
                'name' => 'Kawkareik',
                'state_id' => 5,
            ],
            [
                'name' => 'Kyainseikgyi',
                'state_id' => 5,
            ],
            [
                'name' => 'Magway',
                'state_id' => 6,
            ],
            [
                'name' => 'Yenangyaung',
                'state_id' => 6,
            ],
            [
                'name' => 'Chauk',
                'state_id' => 6,
            ],
            [
                'name' => 'Taungdwingyi',
                'state_id' => 6,
            ],
            [
                'name' => 'Myothit',
                'state_id' => 6,
            ],
            [
                'name' => 'Natmauk',
                'state_id' => 6,
            ],
            [
                'name' => 'Minbu',
                'state_id' => 6,
            ],
            [
                'name' => 'Pwintbyu',
                'state_id' => 6,
            ],
            [
                'name' => 'Ngape',
                'state_id' => 6,
            ],
            [
                'name' => 'Salin',
                'state_id' => 6,
            ],
            [
                'name' => 'Sidoktaya',
                'state_id' => 6,
            ],
            [
                'name' => 'Thayet',
                'state_id' => 6,
            ],
            [
                'name' => 'Minhla',
                'state_id' => 6,
            ],
            [
                'name' => 'Mindon',
                'state_id' => 6,
            ],
            [
                'name' => 'Kamma',
                'state_id' => 6,
            ],
            [
                'name' => 'Aunglan',
                'state_id' => 6,
            ],
            [
                'name' => 'Sinbaungwe',
                'state_id' => 6,
            ],
            [
                'name' => 'Pakokku',
                'state_id' => 6,
            ],
            [
                'name' => 'Yesagyo',
                'state_id' => 6,
            ],
            [
                'name' => 'Myaing',
                'state_id' => 6,
            ],
            [
                'name' => 'Pauk',
                'state_id' => 6,
            ],
            [
                'name' => 'Seikphyu',
                'state_id' => 6,
            ],
            [
                'name' => 'Gangaw',
                'state_id' => 6,
            ],
            [
                'name' => 'Tilin',
                'state_id' => 6,
            ],
            [
                'name' => 'Saw',
                'state_id' => 6,
            ],
            [
                'name' => 'Aungmyaythazan',
                'state_id' => 7,
            ],
            [
                'name' => 'Chanayethazan',
                'state_id' => 7,
            ],
            [
                'name' => 'Mahaaungmyay',
                'state_id' => 7,
            ],
            [
                'name' => 'Chanmyathazi',
                'state_id' => 7,
            ],
            [
                'name' => 'Pyigyitagon',
                'state_id' => 7,
            ],
            [
                'name' => 'Amarapura',
                'state_id' => 7,
            ],
            [
                'name' => 'Patheingyi',
                'state_id' => 7,
            ],
            [
                'name' => 'Pyinoolwin',
                'state_id' => 7,
            ],
            [
                'name' => 'Madaya',
                'state_id' => 7,
            ],
            [
                'name' => 'Singu',
                'state_id' => 7,
            ],
            [
                'name' => 'Mogoke',
                'state_id' => 7,
            ],
            [
                'name' => 'Thabeikkyin',
                'state_id' => 7,
            ],
            [
                'name' => 'Kyaukse',
                'state_id' => 7,
            ],
            [
                'name' => 'Sintgaing',
                'state_id' => 7,
            ],
            [
                'name' => 'Myittha',
                'state_id' => 7,
            ],
            [
                'name' => 'Tada-U',
                'state_id' => 7,
            ],
            [
                'name' => 'Myingyan',
                'state_id' => 7,
            ],
            [
                'name' => 'Taungtha',
                'state_id' => 7,
            ],
            [
                'name' => 'Natogyi',
                'state_id' => 7,
            ],
            [
                'name' => 'Kyaukpadaung',
                'state_id' => 7,
            ],
            [
                'name' => 'Ngazun',
                'state_id' => 7,
            ],
            [
                'name' => 'Nyaung-U',
                'state_id' => 7,
            ],
            [
                'name' => 'Yamethin',
                'state_id' => 7,
            ],
            [
                'name' => 'Pyawbwe',
                'state_id' => 7,
            ],
            [
                'name' => 'Meiktila',
                'state_id' => 7,
            ],
            [
                'name' => 'Mahlaing',
                'state_id' => 7,
            ],
            [
                'name' => 'Thazi',
                'state_id' => 7,
            ],
            [
                'name' => 'Wundwin',
                'state_id' => 7,
            ],
            [
                'name' => 'Mawlamyine',
                'state_id' => 8,
            ],
            [
                'name' => 'Kyaikmaraw',
                'state_id' => 8,
            ],
            [
                'name' => 'Chaungzon',
                'state_id' => 8,
            ],
            [
                'name' => 'Thanbyuzayat',
                'state_id' => 8,
            ],
            [
                'name' => 'Mudon',
                'state_id' => 8,
            ],
            [
                'name' => 'Ye',
                'state_id' => 8,
            ],
            [
                'name' => 'Thaton',
                'state_id' => 8,
            ],
            [
                'name' => 'Paung',
                'state_id' => 8,
            ],
            [
                'name' => 'Kyaikto',
                'state_id' => 8,
            ],
            [
                'name' => 'Bilin',
                'state_id' => 8,
            ],
            [
                'name' => 'Sagaing',
                'state_id' => 9,
            ],
            [
                'name' => 'Myinmu',
                'state_id' => 9,
            ],
            [
                'name' => 'Myaung',
                'state_id' => 9,
            ],
            [
                'name' => 'Shwebo',
                'state_id' => 9,
            ],
            [
                'name' => 'Khin-U',
                'state_id' => 9,
            ],
            [
                'name' => 'Wetlet',
                'state_id' => 9,
            ],
            [
                'name' => 'Kanbalu',
                'state_id' => 9,
            ],
            [
                'name' => 'Kyunhla',
                'state_id' => 9,
            ],
            [
                'name' => 'Ye-U',
                'state_id' => 9,
            ],
            [
                'name' => 'Tabayin',
                'state_id' => 9,
            ],
            [
                'name' => 'Taze',
                'state_id' => 9,
            ],
            [
                'name' => 'Monywa',
                'state_id' => 9,
            ],
            [
                'name' => 'Budalin',
                'state_id' => 9,
            ],
            [
                'name' => 'Ayadaw',
                'state_id' => 9,
            ],
            [
                'name' => 'Chaung-U',
                'state_id' => 9,
            ],
            [
                'name' => 'Yinmarbin',
                'state_id' => 9,
            ],
            [
                'name' => 'Kani',
                'state_id' => 9,
            ],
            [
                'name' => 'Salingyi',
                'state_id' => 9,
            ],
            [
                'name' => 'Pale',
                'state_id' => 9,
            ],
            [
                'name' => 'Katha',
                'state_id' => 9,
            ],
            [
                'name' => 'Indaw',
                'state_id' => 9,
            ],
            [
                'name' => 'Tigyaing',
                'state_id' => 9,
            ],
            [
                'name' => 'Banmauk',
                'state_id' => 9,
            ],
            [
                'name' => 'Kawlin',
                'state_id' => 9,
            ],
            [
                'name' => 'Wuntho',
                'state_id' => 9,
            ],
            [
                'name' => 'Pinlebu',
                'state_id' => 9,
            ],
            [
                'name' => 'Kale',
                'state_id' => 9,
            ],
            [
                'name' => 'Kalewa',
                'state_id' => 9,
            ],
            [
                'name' => 'Mingin',
                'state_id' => 9,
            ],
            [
                'name' => 'Tamu',
                'state_id' => 9,
            ],
            [
                'name' => 'Mawlaik',
                'state_id' => 9,
            ],
            [
                'name' => 'Paungbyin',
                'state_id' => 9,
            ],
            [
                'name' => 'Hkamti',
                'state_id' => 9,
            ],
            [
                'name' => 'Homalin',
                'state_id' => 9,
            ],
            [
                'name' => 'Lay Shi',
                'state_id' => 9,
            ],
            [
                'name' => 'Lahe',
                'state_id' => 9,
            ],
            [
                'name' => 'Nanyun',
                'state_id' => 9,
            ],
            [
                'name' => 'Taunggyi',
                'state_id' => 10,
            ],
            [
                'name' => 'Nyaungshwe',
                'state_id' => 10,
            ],
            [
                'name' => 'Hopong',
                'state_id' => 10,
            ],
            [
                'name' => 'Hsihseng',
                'state_id' => 10,
            ],
            [
                'name' => 'Kalaw',
                'state_id' => 10,
            ],
            [
                'name' => 'Pindaya',
                'state_id' => 10,
            ],
            [
                'name' => 'Ywangan',
                'state_id' => 10,
            ],
            [
                'name' => 'Lawksawk',
                'state_id' => 10,
            ],
            [
                'name' => 'Pinlaung',
                'state_id' => 10,
            ],
            [
                'name' => 'Pekon',
                'state_id' => 10,
            ],
            [
                'name' => 'Loilen',
                'state_id' => 10,
            ],
            [
                'name' => 'Laihka',
                'state_id' => 10,
            ],
            [
                'name' => 'Nansang',
                'state_id' => 10,
            ],
            [
                'name' => 'Kunhing',
                'state_id' => 10,
            ],
            [
                'name' => 'Kyethi',
                'state_id' => 10,
            ],
            [
                'name' => 'Mongkaing',
                'state_id' => 10,
            ],
            [
                'name' => 'Monghsu',
                'state_id' => 10,
            ],
            [
                'name' => 'Langkho',
                'state_id' => 10,
            ],
            [
                'name' => 'Mongnai',
                'state_id' => 10,
            ],
            [
                'name' => 'Mawkmai',
                'state_id' => 10,
            ],
            [
                'name' => 'Mongpan',
                'state_id' => 10,
            ],
            [
                'name' => 'Lashio',
                'state_id' => 11,
            ],
            [
                'name' => 'Hseni',
                'state_id' => 11,
            ],
            [
                'name' => 'Mongyai',
                'state_id' => 11,
            ],
            [
                'name' => 'Tangyan',
                'state_id' => 11,
            ],
            [
                'name' => 'Muse',
                'state_id' => 11,
            ],
            [
                'name' => 'Namhkan',
                'state_id' => 11,
            ],
            [
                'name' => 'Kutkai',
                'state_id' => 11,
            ],
            [
                'name' => 'Kyaukme',
                'state_id' => 11,
            ],
            [
                'name' => 'Nawnghkio',
                'state_id' => 11,
            ],
            [
                'name' => 'Hsipaw',
                'state_id' => 11,
            ],
            [
                'name' => 'Namtu',
                'state_id' => 11,
            ],
            [
                'name' => 'Namhsan',
                'state_id' => 11,
            ],
            [
                'name' => 'Mongmit',
                'state_id' => 11,
            ],
            [
                'name' => 'Mabein',
                'state_id' => 11,
            ],
            [
                'name' => 'Manton',
                'state_id' => 11,
            ],
            [
                'name' => 'Kunlong',
                'state_id' => 11,
            ],
            [
                'name' => 'Laukkaing',
                'state_id' => 11,
            ],
            [
                'name' => 'Konkyan',
                'state_id' => 11,
            ],
            [
                'name' => 'Hopang',
                'state_id' => 11,
            ],
            [
                'name' => 'Matman',
                'state_id' => 11,
            ],
            [
                'name' => 'Kengtung',
                'state_id' => 12,
            ],
            [
                'name' => 'Mongkhet',
                'state_id' => 12,
            ],
            [
                'name' => 'Mongyang',
                'state_id' => 12,
            ],
            [
                'name' => 'Mongla',
                'state_id' => 12,
            ],
            [
                'name' => 'Monghsat',
                'state_id' => 12,
            ],
            [
                'name' => 'Mongping',
                'state_id' => 12,
            ],
            [
                'name' => 'Mongton',
                'state_id' => 12,
            ],
            [
                'name' => 'Tachileik',
                'state_id' => 12,
            ],
            [
                'name' => 'Monghpyak',
                'state_id' => 12,
            ],
            [
                'name' => 'Mongyawng',
                'state_id' => 12,
            ],
            [
                'name' => 'Dawei',
                'state_id' => 13,
            ],
            [
                'name' => 'Launglon',
                'state_id' => 13,
            ],
            [
                'name' => 'Thayetchaung',
                'state_id' => 13,
            ],
            [
                'name' => 'Yebyu',
                'state_id' => 13,
            ],
            [
                'name' => 'Myeik',
                'state_id' => 13,
            ],
            [
                'name' => 'Kyunsu',
                'state_id' => 13,
            ],
            [
                'name' => 'Palaw',
                'state_id' => 13,
            ],
            [
                'name' => 'Tanintharyi',
                'state_id' => 13,
            ],
            [
                'name' => 'Kawthoung',
                'state_id' => 13,
            ],
            [
                'name' => 'Bokpyin',
                'state_id' => 13,
            ],
            [
                'name' => 'Sangkhla Buri',
                'state_id' => 14,
            ],
            [
                'name' => 'Mae Hong Son',
                'state_id' => 15,
            ],
            [
                'name' => 'Khun Yuam',
                'state_id' => 15,
            ],
            [
                'name' => 'Mae Sariang',
                'state_id' => 15,
            ],
            [
                'name' => 'Mae Ramat',
                'state_id' => 16,
            ],
            [
                'name' => 'Tha Song Yang',
                'state_id' => 16,
            ],
            [
                'name' => 'Mae Sot',
                'state_id' => 16,
            ],
            [
                'name' => 'Phop Phra',
                'state_id' => 16,
            ],
            [
                'name' => 'Umphang',
                'state_id' => 16,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('townships');
    }
};
