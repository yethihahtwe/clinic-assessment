<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subdomains', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('domain_id')->constrained('domains')->cascadeOnDelete();
            $table->timestamps();
        });

        // DB::table('subdomains')->insert([
        //     [
        //         'name' => 'Man Power',
        //         'domain_id' => 2,
        //     ],
        //     [
        //         'name' => 'Service Providers',
        //         'domain_id' => 2,
        //     ],
        //     [
        //         'name' => 'Approaching patients',
        //         'domain_id' => 3,
        //     ],
        //     [
        //         'name' => 'General morbidity patient care',
        //         'domain_id' => 3,
        //     ],
        //     [
        //         'name' => 'Infection, prevention and control (Observation)',
        //         'domain_id' => 4,
        //     ],
        //     [
        //         'name' => 'Preventing Injuries from Sharps',
        //         'domain_id' => 4,
        //     ],
        //     [
        //         'name' => 'Cleaning of Examination Area',
        //         'domain_id' => 4,
        //     ],
        //     [
        //         'name' => 'Instrument processing',
        //         'domain_id' => 4,
        //     ],
        //     [
        //         'name' => 'Sterilization and Storing',
        //         'domain_id' => 4,
        //     ],
        //     [
        //         'name' => 'Housekeeping',
        //         'domain_id' => 4,
        //     ],
        //     [
        //         'name' => 'Prevention of Communicable Disease',
        //         'domain_id' => 4,
        //     ],
        //     [
        //         'name' => 'Malaria',
        //         'domain_id' => 5,
        //     ],
        //     [
        //         'name' => 'TB',
        //         'domain_id' => 5,
        //     ],
        //     [
        //         'name' => 'HIV/AIDS',
        //         'domain_id' => 5,
        //     ],
        //     [
        //         'name' => 'Supplies and Equipment',
        //         'domain_id' => 5,
        //     ],
        //     [
        //         'name' => 'Procedures and Related Governance',
        //         'domain_id' => 6,
        //     ],
        //     [
        //         'name' => 'Supplies and Equipment (including use)',
        //         'domain_id' => 6,
        //     ],
        //     [
        //         'name' => 'Emergency Medicines',
        //         'domain_id' => 6,
        //     ],
        //     [
        //         'name' => 'Fluids',
        //         'domain_id' => 6,
        //     ],
        //     [
        //         'name' => 'Training and knowledge',
        //         'domain_id' => 7,
        //     ],
        //     [
        //         'name' => 'Supplies and materials',
        //         'domain_id' => 7,
        //     ],
        //     [
        //         'name' => 'Child health knowledge in general',
        //         'domain_id' => 8,
        //     ],
        //     [
        //         'name' => 'Under 5 growth monitoring',
        //         'domain_id' => 8,
        //     ],
        //     [
        //         'name' => 'Available of equipment',
        //         'domain_id' => 8,
        //     ],
        //     [
        //         'name' => 'Essential child health technical knowledge',
        //         'domain_id' => 8,
        //     ],
        //     [
        //         'name' => '1. Checking availability of medicines: Out of stock in last six months',
        //         'domain_id' => 10,
        //     ],
        //     [
        //         'name' => '2. Random medicine check in storage: Correctness of physical stock balance checking',
        //         'domain_id' => 10,
        //     ],
        //     [
        //         'name' => '3. Infection control items',
        //         'domain_id' => 10,
        //     ],
        //     [
        //         'name' => '4. Essential medicine management',
        //         'domain_id' => 10,
        //     ],
        //     [
        //         'name' => '5. Storage Condition for Pharmaceutical Quality Assurance',
        //         'domain_id' => 10,
        //     ],
        //     [
        //         'name' => '6A. Supplies A: ဆေးခန်းတွင်ရှိ/မရှိ',
        //         'domain_id' => 10,
        //     ],
        //     [
        //         'name' => '6B. Supplies B: ကောင်းမွန်စွာအသုံးပြုနိုင်သည့် အခြေအနေ ရှိ/မရှိ',
        //         'domain_id' => 10,
        //     ],
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subdomains');
    }
};
