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
        Schema::create('update_profile_requests', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->foreignUuid('client_id')->nullable();

            $table->string('update_profile_request')->nullable();

            $table->string('refuse_reasone')->nullable();

            $table->string('admin_notes')->nullable();

            $table->string('client_notes')->nullable();

            $table->foreignUuid('status')->nullable();

            $table->foreignUuid('action_by_id')->nullable();

            $table->timestamp('action_at')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('update_profile_requests');
    }
};
