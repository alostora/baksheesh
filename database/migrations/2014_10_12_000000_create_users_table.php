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
        Schema::create('users', function (Blueprint $table) {

            $table->uuid('id')->primary();

            $table->string('name')->nullable();

            $table->string('email')->unique();

            $table->string('phone')->unique();

            $table->string('address')->nullable();

            $table->string('email_verification_code')->unique()->nullable();

            $table->string('reset_password_code')->unique()->nullable();

            $table->string('password');

            $table->integer('available_companies_count')->nullable();

            $table->integer('available_employees_count')->nullable();

            $table->foreignUuid('country_id')->nullable();

            $table->foreignUuid('user_account_type_id')->nullable();

            $table->foreignUuid('client_id')->nullable();

            $table->foreignUuid('company_id')->nullable();

            $table->foreignUuid('file_id')->nullable();

            $table->timestamp('email_verified_at')->nullable();

            $table->timestamp('stopped_at')->nullable();

            $table->rememberToken();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
