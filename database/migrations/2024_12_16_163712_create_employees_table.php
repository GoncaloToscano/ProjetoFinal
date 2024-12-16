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
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // ID único para o funcionário
            $table->string('name'); // Nome do funcionário
            $table->string('email')->unique(); // Email (único)
            $table->string('position'); // Cargo ou função
            $table->decimal('salary', 8, 2); // Salário
            $table->timestamps(); // Datas de criação e atualização
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
