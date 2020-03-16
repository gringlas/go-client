<?php

namespace Gringlas\GoClient;

use SoapClient;
use Gringlas\GoClient\WSDLTypes\Sendung;
use Gringlas\GoClient\WSDLTypes\Sendungsnummern;
use Gringlas\GoClient\WSDLTypes\PDF\PDFSendung;

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
    private $isLogResponses = true;

    private $isLogRequests = true;

    private $logResponsesPath = "logs/Go/responses/";

    private $logRequestsPath = "logs/Go/responses/";

    /**
     * GoClient constructor.
     * @param $wsdl
     * @param $options see: https://www.php.net/manual/de/soapclient.soapclient.php
     */
    public function __construct($wsdl, $SoapClientOptions, $options = [])
    {
        if (isset($options['logResponses'])) {
            $this->isLogResponses = $options['logResponses'];
        }
        if (isset($options['logResponsesPath'])) {
            $this->logResponsesPath = $options['logResponsesPath'];
        }
        if (isset($options['logRequests'])) {
            $this->isLogRequests = $options['logRequests'];
        }
        if (isset($options['logRequestsPath'])) {
            $this->logRequestsPath = $options['logRequestsPath'];
        }
        $this->soapClient = new SoapClient($wsdl, $SoapClientOptions);
    }


    public function doOrder($sendung, $status = null)
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
            $this->logRequest("SendungsDaten_" . time() . ".xml");
            $this->logResponse("SendungsDaten_" . time() . ".xml");
            return $this->toSendungsRueckmeldung($result);
        } catch (\SoapFault $soapFault) {
            if (strpos($soapFault->faultcode, 'Server')) {
                if (isset($soapFault->detail)) {
                    throw new GoClientException("Die GO Validierung meldet: " . $this->getValidationError($soapFault->detail), GoClientException::CODE_GO_VALIDATION);
                } else {
                    throw new GoClientException("Daten, die an den GO Server geschickt werden, erzeugen folgende Meldung: " . $soapFault->getMessage(), GoClientException::CODE_GO_SERVER_ERROR);
                }
            }
            if ($soapFault->faultcode == 'HTTP') {
                throw new GoClientException("Bitte die SoapClient Konfiguration prüfen: " . $soapFault->getMessage(), GoClientException::CODE_SOAP_CONFIGURATION);
            }
            throw new GoClientException("Es ist ein allgemeiner Fehler aufgetreten", GoClientException::CODE_GENERAL);
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


    public function doOrderStorno($sendung)
    {
        $sendung->Status = self::STATUS_STORNO;
        return $this->doOrder($sendung);
    }

    public function getPDFLabel(Sendungsnummern $sendungsnummern) : PDFSendung
    {
        try {
            $result = $this->soapClient->PDFLabel($sendungsnummern);
            $this->logResponse("PDFLabel" . time() . ".xml");

            $PDFSendung = ClassCreator::PDFSendungFromStdClass($result->Sendung);
            return $PDFSendung;
        } catch (\SoapFault $soapFault) {
            throw new GoClientException("PDF could not get created");
        }
    }


    private function logResponse($filename)
    {
        if ($this->isLogResponses) {
            if (is_dir($this->logResponsesPath)) {
                $xml = $this->soapClient->__getLastResponse();
                file_put_contents($this->logResponsesPath . $filename, $xml);
            }
        }
    }


    private function logRequest($filename)
    {
        if ($this->isLogRequests) {
            if (is_dir($this->logRequestsPath)) {
                $xml = $this->soapClient->__getLastRequest();
                file_put_contents($this->logRequestsPath . $filename, $xml);
            }
        }
    }

    /**
     * SendungsRueckmeldung returns an object containing Sendung
     *
     * @param $data
     * @return mixed
     */
    private function toSendungsRueckmeldung($data)
    {
        if (isset($data->Sendung)) {
            return $data->Sendung;
        } else {
            throw new GoClientException("GO response doesn't contain Sendung object");
        }
    }


    /**
     * ValidationError contains a GOWebService_Fehlerbehandlung
     * @param $validationError
     */
    private function getValidationError($validationError)
    {
        return
            $validationError->GOWebService_Fehlerbehandlung->Fehlermeldungen->Fehler->Feld . ": ".
            $validationError->GOWebService_Fehlerbehandlung->Fehlermeldungen->Fehler->Beschreibung;

    }
}
