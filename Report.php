<?php

use Mpdf\Mpdf;

require_once __DIR__ . '/vendor/autoload.php';

class Report {
    private $customerName;
    private $laundryList;
    private $totalPrices;
    private $mpdf;
    private $location = __DIR__."/Reports";
    private $fileName = "/Laundry list of ";
    private $fileType = ".pdf";

    function __construct()
    {
        $this->mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A5-L']);
    }

    function exportPDF($customerName, $laundryList, $totalPrices) {
        $this->customerName = $customerName;
        $this->laundryList = $laundryList;
        $this->totalPrices = $totalPrices;
        $this->fileName = $this->fileName.$this->customerName.$this->fileType;
        echo "Exporting ".$this->fileName.PHP_EOL;
        $this->mpdf->writeHTML("Hello world");
        $this->mpdf->Output($this->location.$this->fileName, \Mpdf\Output\Destination::FILE);
    }

}

?>