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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('abbr');
            $table->timestamps();
        });

        DB::table('organizations')->insert([
            [
                'name' => 'Ethnic Health System Strengthening Group',
                'abbr' => 'EHSSG',
            ],
            [
                'name' => 'Burma Medical Association',
                'abbr' => 'BMA',
            ],
            [
                'name' => 'Backpack Health Worker Team',
                'abbr' => 'BPHWT',
            ],
            [
                'name' => 'Karen Department of Health and Welfare',
                'abbr' => 'KDHW',
            ],
            [
                'name' => 'Civil Health and Development Network-Karenni',
                'abbr' => 'CHDN-Karenni',
            ],
            [
                'name' => 'Mae Tao Clinic',
                'abbr' => 'MTC',
            ],
            [
                'name' => 'Mon National Health Committee',
                'abbr' => 'MNHC',
            ],
            [
                'name' => 'PaOh Health Working Committee',
                'abbr' => 'PHWC',
            ],
            [
                'name' => 'Kachin Health Network',
                'abbr' => 'KHN',
            ],
            [
                'name' => 'Kachin Women Association-Thailand',
                'abbr' => 'KWAT',
            ],
            [
                'name' => 'Shan Health Committee',
                'abbr' => 'SHC',
            ],
            [
                'name' => 'Chin Health and Education Committee',
                'abbr' => 'CHEC',
            ],
            [
                'name' => 'Ta`ang Health Organization',
                'abbr' => 'THO',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
