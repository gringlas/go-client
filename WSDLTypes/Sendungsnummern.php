<?php


namespace GoApi\Lib\WSDLTypes;


class Sendungsnummern
{

    public function __construct($Seitengroesse, $SendungsnummerAX4)
    {
        $this->Seitengroesse = $Seitengroesse;
        $this->SendungsnummerAX4 = $SendungsnummerAX4;
    }
}
