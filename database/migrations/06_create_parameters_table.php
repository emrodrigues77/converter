<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();
            $table->char("moedaPadrao", 3)->default("BRL");
            $table->decimal("valorMinimo", 10, 2)->unsigned();
            $table->decimal("valorMaximo", 10, 2)->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('parameters');
    }
};