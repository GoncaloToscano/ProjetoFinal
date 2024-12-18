<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToCarsTable extends Migration
{
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string('fuel')->nullable(); // Combustível
            $table->integer('kms')->nullable(); // Quilometragem
            $table->string('color')->nullable(); // Cor
            $table->integer('power')->nullable(); // Potência em CV
            $table->integer('engine_capacity')->nullable(); // Cilindrada em cc
            $table->string('gearbox')->nullable(); // Manual ou Automática
        });
    }

    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['fuel', 'kms', 'color', 'power', 'engine_capacity', 'gearbox']);
        });
    }
}
