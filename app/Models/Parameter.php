<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};

/**
 * Classe de modelagem dos dados dos parâmetros do aplicativo
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class Parameter extends Model {
    use HasFactory;

    protected $fillable = [
        'moedaPadrao',
        'valorMinimo',
        'valorMaximo',
    ];
}
