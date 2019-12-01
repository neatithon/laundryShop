<?php

use Mpdf\Mpdf;

require_once __DIR__ . '/vendor/autoload.php';

class Report {
    private $startDate;
    private $endDate;
    private $mpdf;
    private $location = __DIR__."/Reports";
    private $fileName = "/Report form ";
    private $fileType = ".pdf";

    function __construct()
    {
        $this->mpdf = new Mpdf();
    }

    function exportPDF($startDate, $endDate) {
        $this->startDate = strval($startDate);
        $this->endDate = strval($endDate);
        $this->fileName = $this->fileName.$this->startDate." to ".$this->endDate.$this->fileType;
        echo "From ".$startDate." to ".$endDate.PHP_EOL;
        $this->mpdf->writeHTML("Hello world");
        $this->mpdf->Output($this->location.$this->fileName, \Mpdf\Output\Destination::FILE);
    }

}

?>