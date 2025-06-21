<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'user_email')) {
                $table->string('user_email')->nullable()->after('user_phone');
            }

            if (!Schema::hasColumn('orders', 'notes')) {
                $table->text('notes')->nullable()->after('user_email');
            }

            if (!Schema::hasColumn('orders', 'print_file')) {
                $table->string('print_file')->nullable()->after('notes'); // For uploaded files to print
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'user_email')) {
                $table->dropColumn('user_email');
            }

            if (Schema::hasColumn('orders', 'notes')) {
                $table->dropColumn('notes');
            }

            if (Schema::hasColumn('orders', 'print_file')) {
                $table->dropColumn('print_file');
            }
        });
    }
};
