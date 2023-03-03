<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

use \App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $admin = new User([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'email' => 'admin@test.com',
        ]);

        $admin->makeAdmin();
        $admin->markEmailAsVerified();
        $admin->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::where('username', 'admin')->delete();
    }
};
