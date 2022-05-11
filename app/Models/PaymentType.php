<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};

/**
 * Classe de modelagem dos dados de formas de pagamento
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class PaymentType extends Model {
    use HasFactory;

    protected $table = "payment_types";

    protected $fillable = [
        'nome',
        'taxa'
    ];
}
