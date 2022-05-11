<?php

namespace App\Mail;

use App\Models\Conversion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Classe que envia mensagens de e-mail com os resultados das operações de conversão
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class ConversionResult extends Mailable {
    use Queueable, SerializesModels;

    /**
     * Objeto com os dados da conversão
     *
     * @var Conversion
     */
    public $conversion;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Conversion $conversion) {
        $this->conversion = $conversion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->from('eduardo@eduardo.rodrigues.nom.br', 'Conversor de Moedas')->view('converter.mail');
    }
}
