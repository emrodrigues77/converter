<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Casts\Attribute,
    Factories\HasFactory,
    Model
};

/**
 * Classe de modelagem dos dados das operações de conversão
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class Conversion extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_type_id',
        'moedaOrigem',
        'moedaDestino',
        'valorConversao',
        'valorMoedaDestino',
        'valorCompradoMoedaDestino',
        'taxaPagamento',
        'taxaConversao',
        'valorConvertido',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Estabelece um relacionamento entre este modelo e o de forma de pagamentos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentType() {
        return $this->belongsTo(PaymentType::class, 'payment_type_id', 'id');
    }

    /* Sequência de métodos de acesso que formatam alguns valores para melhor apresentação no frontend */
    protected function valorConversao(): Attribute {
        return Attribute::make(
            get: fn ($value) => number_format($value, 2, ',', '.'),
        );
    }

    protected function taxaPagamento(): Attribute {
        return Attribute::make(
            get: fn ($value) => number_format($value, 2, ',', '.'),
        );
    }

    protected function taxaConversao(): Attribute {
        return Attribute::make(
            get: fn ($value) => number_format($value, 2, ',', '.'),
        );
    }

    protected function valorConvertido(): Attribute {
        return Attribute::make(
            get: fn ($value) => number_format($value, 2, ',', '.'),
        );
    }

    protected function valorMoedaDestino(): Attribute {
        return Attribute::make(
            get: fn ($value) => number_format($value, 4, ',', '.'),
        );
    }

    protected function valorCompradoMoedaDestino(): Attribute {
        return Attribute::make(
            get: fn ($value) => number_format($value, 2, ',', '.'),
        );
    }

    protected function created_at(): Attribute {
        return Attribute::make(
            get: fn ($value) => date("d/m/Y H:i:s", strtotime($value)),
        );
    }
}
