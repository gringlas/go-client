<?php

namespace GoClient\WSDLTypes\PDF;

class PDFSendung
{

    public function __construct($SendungsnummerAX4, $Frachtbriefnummer, PDFs $PDFs)
    {
        $this->SendungsnummerAX4 = $SendungsnummerAX4;
        $this->Frachtbriefnummer = $Frachtbriefnummer;
        $this->PDFs = $PDFs;
    }

}
