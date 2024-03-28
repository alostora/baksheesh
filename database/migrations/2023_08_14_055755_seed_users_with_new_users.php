<?php

use App\Constants\HasLookupType\UserAccountType;
use App\Models\SystemLookup;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $lookup_account_type_root = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('key', UserAccountType::ROOT['key'])
            ->first();

        $lookup_account_type_admin = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('key', UserAccountType::ADMIN['key'])
            ->first();
/*
        $lookup_account_type_client = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('key', UserAccountType::CLIENT['key'])
            ->first();

        $lookup_account_type_employee = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('key', UserAccountType::EMPLOYEE['key'])
            ->first(); */

        $root = User::create([

            'user_account_type_id' => $lookup_account_type_root->id,

            'name' => 'root',

            'email' => 'root@root.com',

            'password' => 123456,

            'phone' => 12345678,

            'address'  => 'root address',

        ]);

        $admin = User::create([

            'user_account_type_id' => $lookup_account_type_admin->id,

            'name' => 'admin',

            'email' => 'admin@admin.com',

            'password' => 123456,

            'phone' => 123456789,

            'address'  => 'admin address',

        ]);
/*
        $client = User::create([

            'user_account_type_id' => $lookup_account_type_client->id,

            'name' => 'client',

            'email' => 'client@client.client',

            'password' => 123456,

            'phone' => 1234567890,

            'address'  => 'client address',

        ]);

        $employee = User::create([

            'user_account_type_id' => $lookup_account_type_employee->id,

            'client_id' => $client->id,

            'name' => 'employee',

            'email' => 'employee@employee.employee',

            'password' => 123456,

            'phone' => 123456789101,

            'address'  => 'employee address',

        ]); */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
