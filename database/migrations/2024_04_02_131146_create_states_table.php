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
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('states')->insert([
            [
                'name' => 'Bago',
            ],
            [
                'name' => 'Chin',
            ],
            [
                'name' => 'Kachin',
            ],
            [
                'name' => 'Karenni',
            ],
            [
                'name' => 'Karen',
            ],
            [
                'name' => 'Magway',
            ],
            [
                'name' => 'Mandalay',
            ],
            [
                'name' => 'Mon',
            ],
            [
                'name' => 'Sagaing',
            ],
            [
                'name' => 'Shan (South)',
            ],
            [
                'name' => 'Shan (North)',
            ],
            [
                'name' => 'Shan (East)',
            ],
            [
                'name' => 'Tanintharyi',
            ],
            [
                'name' => 'Kanchanaburi',
            ],
            [
                'name' => 'Mae Hong Son',
            ],
            [
                'name' => 'Tak',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
