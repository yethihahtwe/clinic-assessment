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
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // DB::table('domains')->insert([
        //     [
        //         'name' => 'Infrastructure',
        //     ],
        //     [
        //         'name' => 'Human Resources',
        //     ],
        //     [
        //         'name' => 'General Examination',
        //     ],
        //     [
        //         'name' => 'Infection prevention and control',
        //     ],
        //     [
        //         'name' => 'AIDS, TB, Malaria',
        //     ],
        //     [
        //         'name' => 'Medical Emergency Management',
        //     ],
        //     [
        //         'name' => 'Maternal and Reproductive Health',
        //     ],
        //     [
        //         'name' => 'Child Health',
        //     ],
        //     [
        //         'name' => 'RDQA1: Data collection and reporting tool',
        //     ],
        //     [
        //         'name' => 'RDQA2: Pharmacy supervision checklist',
        //     ],
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
