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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reported_by');
            $table->unsignedBigInteger('reported_campaign_id');
            $table->text('reason');
            $table->string('status')->default('pending'); // örn: pending, reviewed
            $table->timestamps();

            $table->foreign('reported_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reported_campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
