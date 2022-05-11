<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};

/**
 * Classe de modelagem dos dados das moedas disponíveis para conversão
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class Currency extends Model {
    use HasFactory;
}
