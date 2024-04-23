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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('is_admin')->default(false);
            $table->foreignId('organization_id')->nullable()->constrained('organizations')->cascadeOnDelete();
            $table->string('position')->nullable();
            $table->string('country_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@ehssg.org',
                'is_admin' => true,
                'password' => bcrypt('admin'),
                'organization_id' => 1
            ],
            [
                'name' => 'User',
                'email' => 'user@ehssg.org',
                'is_admin' => false,
                'password' => bcrypt('password'),
                'organization_id' => 1
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
