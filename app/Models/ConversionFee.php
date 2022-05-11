<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};

/**
 * Classe de modelagem dos dados de taxas de conversão
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class ConversionFee extends Model {
    use HasFactory;

    protected $fillable = [
        'valorMaximo',
        'taxa',
    ];
}
