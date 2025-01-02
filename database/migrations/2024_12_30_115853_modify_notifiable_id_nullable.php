<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->string('notifiable_type')->nullable()->change();
        });
        Schema::table('notifications', function (Blueprint $table) {
            $table->string('notifiable_type')->default('default_value')->change();
        });
    }

    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->string('notifiable_type')->nullable(false)->change();
        });
        Schema::table('notifications', function (Blueprint $table) {
            $table->string('notifiable_type')->default(null)->change();
        });
    }

};
