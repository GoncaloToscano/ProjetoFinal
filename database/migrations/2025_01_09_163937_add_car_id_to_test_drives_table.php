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
        Schema::table('test_drives', function (Blueprint $table) {
            $table->unsignedBigInteger('car_id')->after('terms_accepted');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('test_drives', function (Blueprint $table) {
            $table->dropForeign(['car_id']);
            $table->dropColumn('car_id');
        });
    }
    
};
