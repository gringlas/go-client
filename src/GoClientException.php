<?php


namespace Gringlas\GoClient;


use Throwable;

class GoClientException extends \Exception
{

    const CODE_GO_SERVER_ERROR = 10;
    const CODE_GO_VALIDATION = 20;
    const CODE_SOAP_CONFIGURATION = 30;
    const CODE_GENERAL = 40;


}
