<?php


namespace GoClient\WSDLTypes;


class Telefon
{
    public function __construct(
        $LaenderPrefix,
        $Ortsvorwahl,
        $Telefonnummer
    )
    {
        $this->LaenderPrefix = $LaenderPrefix;
        $this->Ortsvorwahl = $Ortsvorwahl;
        $this->Telefonnummer = $Telefonnummer;
    }
}
