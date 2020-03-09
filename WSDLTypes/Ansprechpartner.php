<?php


namespace GoApi\Lib\WSDLTypes;


class Ansprechpartner
{
    public function __construct(
        Telefon $Telefon
    )
    {
        $this->Telefon = $Telefon;
    }
}
