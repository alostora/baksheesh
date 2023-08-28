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
        Schema::create('client_withdrawal_requests', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->foreignUuid('client_id')->nullable();

            $table->integer('amount')->default(0)->nullable();

            $table->double('discount_percentage')->default(0)->nullable();

            $table->string('status')->nullable();

            $table->string('refuse_reasone')->nullable();

            $table->string('notes')->nullable();

            $table->foreignUuid('action_by_id')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_withdrawal_requests');
    }
};
