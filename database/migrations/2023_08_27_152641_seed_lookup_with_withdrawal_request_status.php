<?php

use App\Constants\HasLookupType\WithdrawalRequestStatus;
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
                'type' => WithdrawalRequestStatus::LOOKUP_TYPE,
                'code' => WithdrawalRequestStatus::PENDING['code'],
                'key' => WithdrawalRequestStatus::PENDING['key'],
                'prefix' => WithdrawalRequestStatus::PENDING['prefix'],
                'name' => WithdrawalRequestStatus::PENDING['name'],
                'name_ar' => WithdrawalRequestStatus::PENDING['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => WithdrawalRequestStatus::LOOKUP_TYPE,
                'code' => WithdrawalRequestStatus::ACCEPTED['code'],
                'key' => WithdrawalRequestStatus::ACCEPTED['key'],
                'prefix' => WithdrawalRequestStatus::ACCEPTED['prefix'],
                'name' => WithdrawalRequestStatus::ACCEPTED['name'],
                'name_ar' => WithdrawalRequestStatus::ACCEPTED['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => WithdrawalRequestStatus::LOOKUP_TYPE,
                'code' => WithdrawalRequestStatus::REFUSED['code'],
                'key' => WithdrawalRequestStatus::REFUSED['key'],
                'prefix' => WithdrawalRequestStatus::REFUSED['prefix'],
                'name' => WithdrawalRequestStatus::REFUSED['name'],
                'name_ar' => WithdrawalRequestStatus::REFUSED['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => WithdrawalRequestStatus::LOOKUP_TYPE,
                'code' => WithdrawalRequestStatus::IMPLEMENTED['code'],
                'key' => WithdrawalRequestStatus::IMPLEMENTED['key'],
                'prefix' => WithdrawalRequestStatus::IMPLEMENTED['prefix'],
                'name' => WithdrawalRequestStatus::IMPLEMENTED['name'],
                'name_ar' => WithdrawalRequestStatus::IMPLEMENTED['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => WithdrawalRequestStatus::LOOKUP_TYPE,
                'code' => WithdrawalRequestStatus::UNEXECUTABLE['code'],
                'key' => WithdrawalRequestStatus::UNEXECUTABLE['key'],
                'prefix' => WithdrawalRequestStatus::UNEXECUTABLE['prefix'],
                'name' => WithdrawalRequestStatus::UNEXECUTABLE['name'],
                'name_ar' => WithdrawalRequestStatus::UNEXECUTABLE['name_ar'],
            ],

        );

        DB::table('system_lookups')->insert($models);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('system_lookups')->where('type', WithdrawalRequestStatus::LOOKUP_TYPE)->delete();
    }
};
