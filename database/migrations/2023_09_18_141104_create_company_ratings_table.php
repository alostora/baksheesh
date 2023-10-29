<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('company_ratings', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('guest_key')->nullable();

            $table->foreignUuid('client_id')->nullable();

            $table->foreignUuid('company_id')->nullable();

            $table->foreignUuid('rating_id')->nullable();

            $table->integer('rating_value')->default(0)->nullable();

            $table->string('payer_name')->nullable();

            $table->string('payer_email')->nullable();

            $table->string('payer_phone')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_ratings');
    }
};
