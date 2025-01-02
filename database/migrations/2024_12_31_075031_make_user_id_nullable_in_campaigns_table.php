<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change(); // user_id sütununu nullable yapıyoruz
        });
    }

    public function down()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change(); // rollback yaparken tekrar zorunlu hale getiriyoruz
        });
    }

};
