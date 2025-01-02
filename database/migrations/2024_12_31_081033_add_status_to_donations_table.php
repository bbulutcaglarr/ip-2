<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_status_to_donations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToDonationsTable extends Migration
{
    public function up()
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->string('status')->default('pending'); // 'pending' varsayılan değer olabilir
        });
    }

    public function down()
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
