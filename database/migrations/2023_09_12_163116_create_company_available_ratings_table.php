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
        Schema::create('company_available_ratings', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->foreignUuid('client_id')->nullable();

            $table->foreignUuid('company_id')->nullable();

            $table->string('name')->nullable();

            $table->string('name_ar')->nullable();

            $table->string('stopped_at')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }


    /**
     *
     *
     *
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_available_ratings');
    }
};
