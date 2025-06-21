<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('user_email')->nullable()->after('user_phone');
            $table->text('notes')->nullable()->after('user_email');
            $table->string('print_file')->nullable()->after('notes'); // For uploaded files to print
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['user_email', 'notes', 'print_file']);
        });
    }
};
