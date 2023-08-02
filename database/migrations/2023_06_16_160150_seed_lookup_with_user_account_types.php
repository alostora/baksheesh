<?php

use App\Constants\HasLookupType\UserAccountType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $models = array(

            [
                'id' => Str::uuid()->toString(),
                'type' => UserAccountType::LOOKUP_TYPE,
                'code' => UserAccountType::ROOT['code'],
                'key' => UserAccountType::ROOT['key'],
                'prefix' => UserAccountType::ROOT['prefix'],
                'name' => UserAccountType::ROOT['name'],
                'name_ar' => UserAccountType::ROOT['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => UserAccountType::LOOKUP_TYPE,
                'code' => UserAccountType::ADMIN['code'],
                'key' => UserAccountType::ADMIN['key'],
                'prefix' => UserAccountType::ADMIN['prefix'],
                'name' => UserAccountType::ADMIN['name'],
                'name_ar' => UserAccountType::ADMIN['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => UserAccountType::LOOKUP_TYPE,
                'code' => UserAccountType::CLIENT['code'],
                'key' => UserAccountType::CLIENT['key'],
                'prefix' => UserAccountType::CLIENT['prefix'],
                'name' => UserAccountType::CLIENT['name'],
                'name_ar' => UserAccountType::CLIENT['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => UserAccountType::LOOKUP_TYPE,
                'code' => UserAccountType::WAITER['code'],
                'key' => UserAccountType::WAITER['key'],
                'prefix' => UserAccountType::WAITER['prefix'],
                'name' => UserAccountType::WAITER['name'],
                'name_ar' => UserAccountType::WAITER['name_ar'],
            ],

        );

        DB::table('system_lookups')->insert($models);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('system_lookups')->where('type', UserAccountType::LOOKUP_TYPE)->delete();
    }
};
