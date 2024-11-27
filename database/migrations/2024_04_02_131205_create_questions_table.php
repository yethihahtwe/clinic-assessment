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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->foreignId('domain_id')->constrained('domains')->cascadeOnDelete();
            $table->foreignId('subdomain_id')->nullable()->constrained('subdomains')->cascadeOnDelete();
            $table->foreignId('response_type_id')->constrained('response_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
