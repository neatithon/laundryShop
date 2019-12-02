<?php

use Mpdf\Mpdf;

require_once __DIR__ . '/vendor/autoload.php';
date_default_timezone_set("Asia/Bangkok");

class Report {
    private $customerName;
    private $laundryList;
    private $totalPrices;
    private $type;
    private $prices;
    private $receivedMoney;
    private $change;
    private $discountPrice;
    private $mpdf;
    private $location = __DIR__."/Reports";
    private $fileName = "/Laundry list of ";
    private $fileType = ".pdf";
    private $htmlBody;

    function __construct()
    {
        $this->mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A5-L']);
        $this->mpdf->setAutoTopMargin = 'stretch';
        $this->mpdf->SetHTMLHeader(
            "<h1 style='margin-bottom: 4px;'>Laundry shop</h1>
            <div class='shopInfo' style='text-decoration: none !important; font-size: 10pt;'>
                <p>Tel: 091-000-0463</p>
                <p>Date: ".date("d-m-Y h:i:sa")."
            </div><hr/>"
        );
    }

    function bindingToBody() {
        $total = 0;
        foreach ($this->totalPrices as $price) {
            $total += $price;
        }
        $this->htmlBody = "<body>
        <div class='customerInfo'>
            <div class ='customerName'>Customer name: ".$this->customerName."</div>
            <div class='laundryList'>
                <table style='width: 100%'>
                    <tr>
                        <th style='text-align: left;'>Laundry list</th>
                        <th>Quality</th>
                        <th>Price/Unit</th>
                        <th style='text-align: right;'>Total</th>
                    </tr>";
        foreach ($this->type as $item) {
            $this->htmlBody .= 
            "<tr>
                <td>".$item."</td>
                <td style='text-align: center;'>".$this->laundryList[$item]."</td>
                <td style='text-align: center;'>".$this->prices[$item]."</td>
                <td style='text-align: right;'>".$this->totalPrices[$item]." Baht </td>
            </tr>";
        }

        $this->htmlBody .= 
        "<tr style='margin-top: 16px; border-bottom: 1px solid black;'>
            <td></td>
            <td></td>
            <td></td>
            <td style='text-align: right; font-weight: 700 !important; border-bottom: 1px solid black;'> Total  ".$total." Baht </td>
        </tr>";

        $this->htmlBody .= 
        "<tr>
            <td></td>
            <td></td>
            <td></td>
            <td style='text-align: right;'> Received  ".$this->receivedMoney." Baht </td>
        </tr>";

        if ($this->discountPrice != 0) {
            $this->htmlBody .= 
        "<tr>
            <td></td>
            <td></td>
            <td></td>
            <td style='text-align: right;'> Discount  ".$this->discountPrice." Baht </td>
        </tr>";
        }

        $this->htmlBody .= 
        "<tr>
            <td></td>
            <td></td>
            <td></td>
            <td style='text-align: right;'> Change  ".$this->change." Baht </td>
        </tr>";

        $this->htmlBody .= "</table></div></div></body>";
    }

    function exportPDF($customerName, $type, $laundryList, $prices, $totalPrices, $receivedMoney, $change, $discountPrice) {
        $this->customerName = $customerName;
        $this->laundryList = $laundryList;
        $this->totalPrices = $totalPrices;
        $this->type = $type;
        $this->prices = $prices;
        $this->receivedMoney = $receivedMoney;
        $this->change = $change;
        $this->discountPrice = $discountPrice;
        $this->fileName = $this->fileName.$this->customerName.$this->fileType;
        echo "Exporting.....".PHP_EOL;
        $this->bindingToBody();
        $this->mpdf->writeHTML($this->htmlBody);
        try {
            $this->mpdf->Output($this->location.$this->fileName, \Mpdf\Output\Destination::FILE);
            echo "\e[92mSuccuessfully exported.\e[0m".PHP_EOL;
        } catch (Exception $e) {
            echo "\e[32m[Error]: Something went wrong while exporting the file please try again later\e[0m";
        }
    }

}
