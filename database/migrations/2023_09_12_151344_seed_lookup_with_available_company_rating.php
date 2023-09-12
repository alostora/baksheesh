<?php

use App\Constants\HasLookupType\AvailableCompanyRating;
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
                'type' => AvailableCompanyRating::LOOKUP_TYPE,
                'code' => AvailableCompanyRating::CLEANLINEES_LEVEL['code'],
                'key' => AvailableCompanyRating::CLEANLINEES_LEVEL['key'],
                'prefix' => AvailableCompanyRating::CLEANLINEES_LEVEL['prefix'],
                'name' => AvailableCompanyRating::CLEANLINEES_LEVEL['name'],
                'name_ar' => AvailableCompanyRating::CLEANLINEES_LEVEL['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => AvailableCompanyRating::LOOKUP_TYPE,
                'code' => AvailableCompanyRating::SERVICE_LEVEL['code'],
                'key' => AvailableCompanyRating::SERVICE_LEVEL['key'],
                'prefix' => AvailableCompanyRating::SERVICE_LEVEL['prefix'],
                'name' => AvailableCompanyRating::SERVICE_LEVEL['name'],
                'name_ar' => AvailableCompanyRating::SERVICE_LEVEL['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => AvailableCompanyRating::LOOKUP_TYPE,
                'code' => AvailableCompanyRating::PRICE_LEVEL['code'],
                'key' => AvailableCompanyRating::PRICE_LEVEL['key'],
                'prefix' => AvailableCompanyRating::PRICE_LEVEL['prefix'],
                'name' => AvailableCompanyRating::PRICE_LEVEL['name'],
                'name_ar' => AvailableCompanyRating::PRICE_LEVEL['name_ar'],
            ],
            [
                'id' => Str::uuid()->toString(),
                'type' => AvailableCompanyRating::LOOKUP_TYPE,
                'code' => AvailableCompanyRating::PRODUCT_QUALITY_LEVEL['code'],
                'key' => AvailableCompanyRating::PRODUCT_QUALITY_LEVEL['key'],
                'prefix' => AvailableCompanyRating::PRODUCT_QUALITY_LEVEL['prefix'],
                'name' => AvailableCompanyRating::PRODUCT_QUALITY_LEVEL['name'],
                'name_ar' => AvailableCompanyRating::PRODUCT_QUALITY_LEVEL['name_ar'],
            ],

        );

        DB::table('system_lookups')->insert($models);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('system_lookups')->where('type', AvailableCompanyRating::LOOKUP_TYPE)->delete();

    }
};
