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
            $table->boolean('confirmed')->default(false); // Coluna confirmed com valor padrão 'false'
        });
    }
    
    public function down()
    {
        Schema::table('test_drives', function (Blueprint $table) {
            $table->dropColumn('confirmed');
        });
    }
    
};
