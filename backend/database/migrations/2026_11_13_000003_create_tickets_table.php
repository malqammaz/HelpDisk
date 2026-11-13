<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('org_id')->constrained('organizations');
            $table->unsignedInteger('ticket_number');
            $table->foreignId('requester_user_id');
            $table->foreignId('assigned_to_user_id')->nullable();
            $table->string('subject');
            $table->text('description');
            $table->string('priority');
            $table->string('status');
            $table->timestamps();
            $table->timestamp('resolved_at')->nullable();

            $table->unique(['org_id', 'ticket_number']);
            $table->foreign(['requester_user_id', 'org_id'], 'tickets_requester_membership_fk')
                ->references(['user_id', 'org_id'])->on('users_organizations');
            $table->foreign(['assigned_to_user_id', 'org_id'], 'tickets_assignee_membership_fk')
                ->references(['user_id', 'org_id'])->on('users_organizations');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
