<?php


namespace Gringlas\GoClient\WSDLTypes;


class SendungsPosition
{
    public function __construct(
        $AnzahlPackstuecke,
        $Gewicht,
        $Inhalt,
        Abmessungen $Abmessungen = null
    )
    {
        $this->AnzahlPackstuecke = $AnzahlPackstuecke;
        $this->Gewicht = $Gewicht;
        $this->Inhalt = $Inhalt;
        $this->Abmessungen = $Abmessungen;
    }
}
