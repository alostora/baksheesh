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
        Schema::create('rating_for_guests', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('client_id')->nullable();

            $table->foreignUuid('company_id')->nullable();

            $table->foreignUuid('employee_id')->nullable();

            $table->foreignUuid('available_rating_id')->nullable();

            $table->timestamp('action_at')->nullable();

            $table->string('stopped_at')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating_for_guests');
    }
};
