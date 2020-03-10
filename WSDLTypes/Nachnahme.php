<?php


namespace gringlas\GoClient\WSDLTypes;


class Nachnahme
{
    public function __construct(
        $Betrag,
        $Waehrung,
        $Zahlungsart
    )
    {
        $this->Betrag = $Betrag;
        $this->Waehrung = $Waehrung;
        $this->Zahlungsart = $Zahlungsart;
    }
}
