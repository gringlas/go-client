<?php


namespace gringlas\GoClient\WSDLTypes;


class Ansprechpartner
{
    public function __construct(
        Telefon $Telefon
    )
    {
        $this->Telefon = $Telefon;
    }
}
