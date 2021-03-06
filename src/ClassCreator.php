<?php


namespace Gringlas\GoClient;

use Gringlas\GoClient\WSDLTypes\PDF\PDFs;
use Gringlas\GoClient\WSDLTypes\PDF\PDFSendung;

class ClassCreator
{
    public static function PDFSendungFromStdClass($input) : PDFSendung
    {
        $PDFs = self::PDFsFromStdClass($input->PDFs);
        $PDFSendung = new PDFSendung($input->SendungsnummerAX4, $input->Frachtbriefnummer, $PDFs);

        return $PDFSendung;
    }


    public static function PDFsFromStdClass($input) : PDFs
    {
        $PDFs = new PDFs($input->Frachtbrief, $input->Routerlabel, $input->RouterlabelZebra);
        return $PDFs;
    }
}
