<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            // Check if role column doesn't exist before adding it
            if (!Schema::hasColumn('admins', 'role')) {
                $table->enum('role', ['admin', 'super_admin'])->default('admin')->after('email');
            }
        });
    }

    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            if (Schema::hasColumn('admins', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
};
