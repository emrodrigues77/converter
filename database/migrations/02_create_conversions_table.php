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
        Schema::create('conversions', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('payment_type_id')->constrained()->onDelete('restrict')->onUpdate('cascade');
            $table->char("moedaOrigem", 3);
            $table->char("moedaDestino", 3);
            $table->decimal('valorConversao', 10, 2)->unsigned();
            $table->decimal('valorMoedaDestino', 10, 4)->unsigned();
            $table->decimal('valorCompradoMoedaDestino', 10, 2)->unsigned();
            $table->decimal('taxaPagamento', 10, 2)->unsigned();
            $table->decimal('taxaConversao', 10, 2)->unsigned();
            $table->decimal('valorConvertido', 10, 2)->unsigned();
            $table->timestamps();
            $table->softDeletes();
            Schema::enableForeignKeyConstraints();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('conversions');
    }
};