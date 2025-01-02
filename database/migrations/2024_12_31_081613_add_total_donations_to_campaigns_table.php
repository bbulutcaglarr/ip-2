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
            $table->decimal('total_donations', 15, 2)->default(0);  // toplam bağış sütunu ekliyoruz
        });
    }

    public function down()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn('total_donations');
        });
    }

};
