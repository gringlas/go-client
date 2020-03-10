<?php

namespace Gringlas\GoClient\WSDLTypes;


class Geldbetrag
{
    public function __construct(
        $Betrag,
        $Waehrung
    )
    {
        $this->Betrag = $Betrag;
        $this->Waehrung = $Waehrung;
    }
}
