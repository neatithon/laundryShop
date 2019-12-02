<?php

use Mpdf\Mpdf;

require_once __DIR__ . '/vendor/autoload.php';
date_default_timezone_set("Asia/Bangkok");

class Report {
    private $customerName;
    private $customerNumber;
    private $shopName;
    private $shopTel;
    private $shopAddress;
    private $laundryList;
    private $totalPrices;
    private $type;
    private $prices;
    private $receivedMoney;
    private $change;
    private $discountPrice;
    private $date;
    private $mpdf;
    private $location;
    private $fileName;
    private $fileType;
    private $htmlBody;

    function __construct()
    {
        $this->shopTel = "091-000-0463";
        $this->shopAddress = "100/4 Moo 5 Suthep Chiang Mai 50200";
        $this->shopName = "Laundry shop";
        $this->location = __DIR__."/Reports";
        $this->date = date("d-m-Y H:i:s");
        $this->fileName = "/".$this->date." of ";
        $this->fileType = ".pdf";
        $this->mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A5-L']);
        $this->mpdf->setAutoTopMargin = 'stretch';
        $this->mpdf->SetHTMLFooter(
            "<div style='text-align: center'>You can get your stuff after 2 days.</div>"
        );
    }

    function bindingHeader() {
        $this->mpdf->SetHTMLHeader(
            "<h1 style='margin-bottom: 4px;'>".$this->shopName."</h1>
            <table>
                <tr>
                    <td style='vertical-align: top; border-right: 1px solid black;'>
                        <div class='shopInfo' style='text-decoration: none !important; font-size: 10pt;'>
                            <p><b>Address:</b> ".$this->shopAddress."</p>
                            <p><b>Shop number:</b> ".$this->shopTel."</p>
                            <p><b>Date:</b> ".$this->date." </p>
                        </div>
                    </td>
                    <td style='vertical-align: top;'>
                        <div class ='customerName' style='text-decoration: none !important; font-size: 10pt; text-align: right;'><b>Customer name:</b> ".$this->customerName."</div>
                        <div class ='customerNumber' style='text-decoration: none !important; font-size: 10pt; text-align: right;'><b>Customer number:</b> ".$this->customerNumber."</div>
                    </td>
                </tr>
            </table>
            <hr/>"
        );
    }

    function bindingToBody() {
        $total = 0;
        foreach ($this->totalPrices as $price) {
            $total += $price;
        }
        $this->htmlBody = "<body>
        <div class='customerInfo'>
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
                <td style='text-align: center;'>".number_format((float)$this->prices[$item], 2, '.', '')."</td>
                <td style='text-align: right;'>".number_format((float)$this->totalPrices[$item], 2, '.', '')." Baht </td>
            </tr>";
        }

        $this->htmlBody .= 
        "<tr style='margin-top: 16px; border-bottom: 1px solid black;'>
            <td></td>
            <td></td>
            <td></td>
            <td style='text-align: right; font-weight: 700 !important; border-bottom: 1px solid black;'> Total  ".number_format((float)$total, 2, '.', '')." Baht </td>
        </tr>";

        $this->htmlBody .= 
        "<tr>
            <td></td>
            <td></td>
            <td></td>
            <td style='text-align: right;'> Received  ".number_format((float)$this->receivedMoney, 2, '.', '')." Baht </td>
        </tr>";

        if ($this->discountPrice != 0) {
            $this->htmlBody .= 
        "<tr>
            <td></td>
            <td></td>
            <td></td>
            <td style='text-align: right;'> Discount  ".number_format((float)$this->discountPrice, 2, '.', '')." Baht </td>
        </tr>";
        }

        $this->htmlBody .= 
        "<tr>
            <td></td>
            <td></td>
            <td></td>
            <td style='text-align: right;'> Change  ".number_format((float)$this->change, 2, '.', '')." Baht </td>
        </tr>";

        $this->htmlBody .= "</table></div></div></body>";
    }

    function exportPDF($customerName, $customerNumber, $type, $laundryList, $prices, $totalPrices, $receivedMoney, $change, $discountPrice) {
        $this->customerName = $customerName;
        $this->customerNumber = $customerNumber;
        $this->laundryList = $laundryList;
        $this->totalPrices = $totalPrices;
        $this->type = $type;
        $this->prices = $prices;
        $this->receivedMoney = $receivedMoney;
        $this->change = $change;
        $this->discountPrice = $discountPrice;
        $this->fileName = $this->fileName.$this->customerName.$this->fileType;
        echo "Exporting.....".PHP_EOL;
        $this->bindingHeader();
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
