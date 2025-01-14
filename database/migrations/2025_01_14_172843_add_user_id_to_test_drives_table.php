<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToTestDrivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('test_drives', function (Blueprint $table) {
            // Adiciona a coluna user_id com a chave estrangeira
            $table->unsignedBigInteger('user_id')->nullable(); // nullable caso o test drive não tenha um usuário associado imediatamente

            // Define a chave estrangeira
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_drives', function (Blueprint $table) {
            // Remove a chave estrangeira e a coluna user_id
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
