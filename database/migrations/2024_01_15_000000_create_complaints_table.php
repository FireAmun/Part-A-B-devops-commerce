<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('user_email');
            $table->string('user_phone')->nullable();
            $table->string('complaint_type'); // 'vendor_specific' or 'general'
            $table->unsignedBigInteger('vendor_id')->nullable(); // null for general complaints
            $table->string('subject');
            $table->text('description');
            $table->string('priority')->default('medium'); // low, medium, high
            $table->string('status')->default('pending'); // pending, in_progress, resolved, closed
            $table->text('admin_response')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
