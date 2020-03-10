<?php
namespace GoClient\WSDLTypes;

class Sendung
{
    public function __construct(
        $SendungsnummerAX4 = null,
        $Frachtbriefnummer = null,
        $Versender,
        $Benutzername,
        $Status,
        $Kundenreferenz = null,
        Abholadresse $Abholadresse,
        Empfaenger $Empfaenger,
        $Service,
        Datum $Abholdatum,
        Datum $Zustelldatum = null,
        $unfrei,
        $Selbstanlieferung,
        $Selbstabholung,
        Geldbetrag $Warenwert = null,
        Geldbetrag $Sonderversicherung = null,
        Nachnahme $Nachnahme = null,
        $Abholhinweise = null,
        $Zustellhinweise= null,
        $TelefonEmpfangsbestaetigung = null,
        SendungsPosition $SendungsPosition
    ) {
        $this->SendungsnummerAX4 = $SendungsnummerAX4;
        $this->Frachtbriefnummer = $Frachtbriefnummer;
        $this->Versender = $Versender;
        $this->Benutzername = $Benutzername;
        $this->Status = $Status;
        $this->Kundenreferenz = $Kundenreferenz;
        $this->Abholadresse = $Abholadresse;
        $this->Empfaenger = $Empfaenger;
        $this->Service = $Service;
        $this->Abholdatum = $Abholdatum;
        $this->Zustelldatum = $Zustelldatum;
        $this->unfrei = $unfrei;
        $this->Selbstanlieferung = $Selbstanlieferung;
        $this->Selbstabholung = $Selbstabholung;
        $this->Warenwert = $Warenwert;
        $this->Sonderversicherung = $Sonderversicherung;
        $this->Nachnahme = $Nachnahme;
        $this->Abholhinweise = $Abholhinweise;
        $this->Zustellhinweise = $Zustellhinweise;
        $this->TelefonEmpfangsbestaetigung = $TelefonEmpfangsbestaetigung;
        $this->SendungsPosition = $SendungsPosition;
    }
}
