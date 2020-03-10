<?php


namespace GoClient\WSDLTypes;


class Datum
{
    public function __construct(
        $Datum,
        $UhrzeitVon,
        $UhrzeitBis
    ) {
        $this->Datum = $Datum;
        $this->UhrzeitVon = $UhrzeitVon;
        $this->UhrzeitBis = $UhrzeitBis;
    }

}
