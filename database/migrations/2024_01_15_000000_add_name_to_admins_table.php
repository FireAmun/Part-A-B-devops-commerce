<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            // Check if name column doesn't exist before adding it
            if (!Schema::hasColumn('admins', 'name')) {
                $table->string('name')->after('id');
            }
        });
    }

    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            if (Schema::hasColumn('admins', 'name')) {
                $table->dropColumn('name');
            }
        });
    }
};
