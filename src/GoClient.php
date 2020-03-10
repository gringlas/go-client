<?php

namespace gringlas\GoClient;

use GoApi\Lib\WSDLTypes\PDF\PDFSendung;
use GoApi\Lib\WSDLTypes\Sendung;
use GoApi\Lib\WSDLTypes\Sendungsnummern;
use SoapClient;

class GoClient
{

    const STATUS_NEW = 1;
    const STATUS_RELEASE = 3;
    const STATUS_STORNO = 20;


    /**
     * @var SoapClient
     */
    private $soapClient;


    /**
     * when true soapClient will call __getLastResponse and store
     * responses to $xmlResponsesPath into files called functionname_timestamp.xml.
     * Will only work if $options['trace'] = true is passed to SoapClient
     *
     * @var bool
     */
    private $isSaveResponse = true;

    private $xmlResponsesPath = "logs/Go/responses/";

    /**
     * GoClient constructor.
     * @param $wsdl
     * @param $options see: https://www.php.net/manual/de/soapclient.soapclient.php
     */
    public function __construct($wsdl, $options)
    {
        $this->soapClient = new SoapClient($wsdl, $options);
    }


    public function doOrder(Sendung $sendung, $status = null)
    {
        if ($status) {
            switch($status) {
                case self::STATUS_NEW:
                    $sendung = $this->doOrderNew($sendung);
                    break;
                case self::STATUS_RELEASE:
                    $sendung = $this->doOrderRelease($sendung);
                    break;
                case self::STATUS_STORNO:
                    $sendung = $this->doOrderStorno($sendung);
                    break;
            }
        }
        try {
            $result = $this->soapClient->SendungsDaten($sendung);
            $this->saveResponse("SendungsDaten_" . time() . ".xml");
            return $result;
        } catch (\SoapFault $soapFault) {
            $goClientException = new GoClientException("PDF could not get created");
            $goClientException->goErrors = $soapFault->detail;
            var_dump($soapFault->getMessage());
            die("SendungsDaten Soap Fault");
        }
    }


    public function doOrderNew(Sendung $sendung)
    {
        $sendung->Status = self::STATUS_NEW;
        return $this->doOrder($sendung);
    }


    public function doOrderRelease(Sendung $sendung)
    {
        $sendung->Status = self::STATUS_RELEASE;
        return $this->doOrder($sendung);
    }


    public function doOrderStorno(Sendung $sendung)
    {
        $sendung->Status = self::STATUS_STORNO;
        return $this->doOrder($sendung);
    }

    public function getPDFLabel(Sendungsnummern $sendungsnummern) : PDFSendung
    {
        try {
            $result = $this->soapClient->PDFLabel($sendungsnummern);
            $this->saveResponse("PDFLabel" . time() . ".xml");

            $PDFSendung = ClassCreator::PDFSendungFromStdClass($result->Sendung);
            return $PDFSendung;
        } catch (\SoapFault $soapFault) {
            throw new GoClientException("PDF could not get created");
        }
    }


    private function saveResponse($filename)
    {
        if ($this->isSaveResponse) {
            if (is_dir($this->xmlResponsesPath)) {
                $xml = $this->soapClient->__getLastResponse();
                file_put_contents($this->xmlResponsesPath . $filename, $xml);
            }
        }
    }
}
