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
        Schema::create('employee_cashes', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->foreignUuid('client_id')->nullable();

            $table->foreignUuid('company_id')->nullable();

            $table->foreignUuid('employee_id')->nullable();

            $table->integer('amount')->default(0)->nullable();

            $table->string('payer_name')->nullable();

            $table->string('payer_email')->nullable();

            $table->string('payer_phone')->nullable();

            $table->string('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_cashes');
    }
};
