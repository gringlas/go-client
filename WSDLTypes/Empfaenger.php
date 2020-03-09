<?php


namespace GoApi\Lib\WSDLTypes;


class Empfaenger
{
    public function __construct(
        $Firmenname1,
        $Firmenname2,
        $Abteilung,
        $Strasse1,
        $Hausnummer,
        $Strasse2,
        $Land,
        $Postleitzahl,
        $Stadt,
        $Email,
        $Ansprechpartner
    )
    {
        $this->Firmenname1 = $Firmenname1;
        $this->Firmenname2 = $Firmenname2;
        $this->Abteilung = $Abteilung;
        $this->Strasse1 = $Strasse1;
        $this->Hausnummer = $Hausnummer;
        $this->Strasse2 = $Strasse2;
        $this->Land = $Land;
        $this->Postleitzahl = $Postleitzahl;
        $this->Stadt = $Stadt;
        $this->Email = $Email;
        $this->Ansprechpartner = $Ansprechpartner;
    }
}
