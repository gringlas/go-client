<?php

namespace GoApi\Lib\WSDLTypes\PDF;

class PDFs
{
    public function __construct($Frachtbrief, $Routerlabel, $RouterlabelZebra)
    {
        $this->Frachtbrief = $Frachtbrief;
        $this->Routerlabel = $Routerlabel;
        $this->RouterlabelZebra = $RouterlabelZebra;
    }


    public function asFile($property, $output)
    {
        if (isset($this->{$property})) {
            $fileHandle = fopen($output, "wb");
            fwrite($fileHandle, $this->{$property});
            fclose($fileHandle);
            return $output;
        }
    }
}
