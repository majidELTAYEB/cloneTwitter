<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use App\Controllers\Controller;

class NotFoundException extends Exception {

    public function __construct($message = "", $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function error404()
    {
        http_response_code(404);
        $path = 'errors/error404';
        require VIEWS.$path.'.phtml';
    }
}


// class Error extends NotFoundException{

// }
// class Error404 extends Controller{
//     public function error404()
//     {
//         http_response_code(404);
//         return $this->simpleView('errors.error404');
//     }
// }
