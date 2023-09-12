<?php

use App\Constants\HasLookupType\AvailableEmployeeRating;
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
                'type' => AvailableEmployeeRating::LOOKUP_TYPE,
                'code' => AvailableEmployeeRating::CLEANLINEES_LEVEL['code'],
                'key' => AvailableEmployeeRating::CLEANLINEES_LEVEL['key'],
                'prefix' => AvailableEmployeeRating::CLEANLINEES_LEVEL['prefix'],
                'name' => AvailableEmployeeRating::CLEANLINEES_LEVEL['name'],
                'name_ar' => AvailableEmployeeRating::CLEANLINEES_LEVEL['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => AvailableEmployeeRating::LOOKUP_TYPE,
                'code' => AvailableEmployeeRating::BEHAVIOR_LEVEL['code'],
                'key' => AvailableEmployeeRating::BEHAVIOR_LEVEL['key'],
                'prefix' => AvailableEmployeeRating::BEHAVIOR_LEVEL['prefix'],
                'name' => AvailableEmployeeRating::BEHAVIOR_LEVEL['name'],
                'name_ar' => AvailableEmployeeRating::BEHAVIOR_LEVEL['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => AvailableEmployeeRating::LOOKUP_TYPE,
                'code' => AvailableEmployeeRating::ETHICS_LEVEL['code'],
                'key' => AvailableEmployeeRating::ETHICS_LEVEL['key'],
                'prefix' => AvailableEmployeeRating::ETHICS_LEVEL['prefix'],
                'name' => AvailableEmployeeRating::ETHICS_LEVEL['name'],
                'name_ar' => AvailableEmployeeRating::ETHICS_LEVEL['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => AvailableEmployeeRating::LOOKUP_TYPE,
                'code' => AvailableEmployeeRating::SERVICE_LEVEL['code'],
                'key' => AvailableEmployeeRating::SERVICE_LEVEL['key'],
                'prefix' => AvailableEmployeeRating::SERVICE_LEVEL['prefix'],
                'name' => AvailableEmployeeRating::SERVICE_LEVEL['name'],
                'name_ar' => AvailableEmployeeRating::SERVICE_LEVEL['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => AvailableEmployeeRating::LOOKUP_TYPE,
                'code' => AvailableEmployeeRating::PROFESSIONALISM_LEVEL['code'],
                'key' => AvailableEmployeeRating::PROFESSIONALISM_LEVEL['key'],
                'prefix' => AvailableEmployeeRating::PROFESSIONALISM_LEVEL['prefix'],
                'name' => AvailableEmployeeRating::PROFESSIONALISM_LEVEL['name'],
                'name_ar' => AvailableEmployeeRating::PROFESSIONALISM_LEVEL['name_ar'],
            ],

        );

        DB::table('system_lookups')->insert($models);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('system_lookups')->where('type', AvailableEmployeeRating::LOOKUP_TYPE)->delete();

    }
};
