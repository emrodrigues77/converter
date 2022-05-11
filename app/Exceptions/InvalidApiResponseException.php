<?php

namespace App\Exceptions;

use Exception;

/**
 * Classe que trata a exceção que pode ocorrer durante as requisições à API
 *
 * @author Eduardo Magela Rodrigues <emrodrigues77@gmail.com>
 * @version 1.0
 */
class InvalidApiResponseException extends Exception {
    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report() {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request) {
        return view('converter.api-error');
    }
}