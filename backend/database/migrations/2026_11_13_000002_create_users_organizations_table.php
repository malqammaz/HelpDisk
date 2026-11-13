<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users_organizations', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('org_id')->constrained('organizations');
            $table->string('role');
            $table->boolean('is_active')->default(true);
            $table->timestamp('joined_at')->useCurrent();

            $table->primary(['user_id', 'org_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_organizations');
    }
};
