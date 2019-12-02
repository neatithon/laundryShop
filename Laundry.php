<?php
require_once "Report.php";
class Laundry {
    private $prices;
    private $laundryList;
    private $totalPrices;
    private $customerName;
    private $shirtAmount;
    private $tShirtAmount;
    private $pantsAmount;
    private $blanketAmount;
    private $underwareAmount;
    private $towelAmount;
    private $type;
    private $report;

    function __construct()
    {
        $this->totalPrices = [];
        $this->type = ["Shirt", "T-shirt", "Pants", "Blanket", "Towel", "Underware"];
        $this->prices['shirt'] = 5;
        $this->prices['tShirt'] = 10;
        $this->prices['pants'] = 10;
        $this->prices['blanket'] = 50;
        $this->prices['underware'] = 3;
        $this->prices['towel'] = 20;
        $this->report = new Report();
    }

    function laundry() {
        $this->getCustomerName();
        $this->getShirtAmount();
        $this->getTShirtAmount();
        $this->getPantsAmount();
        $this->getBlanketAmount();
        $this->getTowelAmount();
        $this->getUnderwareAmount();
        $this->printInputtedInfo();
        $this->printSumary();
    }

    function getCustomerName() {
        $this->customerName = readline("\r\nInput the customer name plase......\r\n");
        if (strlen($this->customerName) == 0) {
            echo "\r\nPlease input the customer name.\r\n";
            $this->getCustomerName();
        }
    }

    function getShirtAmount() {
        $inputData = readline("\r\nEnter the amount of all shirts.  (Input 0 if no shirt)\r\n");
        if (preg_match('/^[0-9]+$/', $inputData)) {
            $this->shirtAmount = (int)$inputData;
        } else {
            $this->displayAmountError();
            $this->getShirtAmount();
        }
    }

    function getTShirtAmount() {
        $inputData = readline("\r\nEnter the amount of all t-shirts.    (Input 0 if no t-shirt)\r\n");
        if (preg_match('/^[0-9]+$/', $inputData)) {
            $this->tShirtAmount = (int)$inputData;
        } else {
            $this->displayAmountError();
            $this->getTShirtAmount();
        }
    }

    function getPantsAmount() {
        $inputData = readline("\r\nEnter the amount of all pants.   (Input 0 if no pants)\r\n");
        if (preg_match('/^[0-9]+$/', $inputData)) {
            $this->pantsAmount = (int)$inputData;
        } else {
            $this->displayAmountError();
            $this->getPantsAmount();
        }
    }

    function getBlanketAmount() {
        $inputData = readline("\r\nEnter the amount of all blanket.   (Input 0 if no blanket)\r\n");
        if (preg_match('/^[0-9]+$/', $inputData)) {
            $this->blanketAmount = (int)$inputData;
        } else {
            $this->displayAmountError();
            $this->getBlanketAmount();
        }
    }

    function getUnderwareAmount() {
        $inputData = readline("\r\nEnter the amount of all underware.   (Input 0 if no underware)\r\n");
        if (preg_match('/^[0-9]+$/', $inputData)) {
            $this->underwareAmount = (int)$inputData;
        } else {
            $this->displayAmountError();
            $this->getUnderwareAmount();
        }
    }

    function getTowelAmount() {
        $inputData = readline("\r\nEnter the amount of all towel.   (Input 0 if no towel)\r\n");
        if (preg_match('/^[0-9]+$/', $inputData)) {
            $this->towelAmount = (int)$inputData;
        } else {
            $this->displayAmountError();
            $this->getTowelAmount();
        }
    }

    function printInputtedInfo() {
        echo "\r\nDo you want to check bill the following summary?\r\n".PHP_EOL;
        echo "      Customer name is : '".$this->customerName."'".PHP_EOL;
        if ($this->shirtAmount > 0) {
            echo "      Amount of shirt is : ".$this->shirtAmount.PHP_EOL;
        }
        if ($this->tShirtAmount > 0) {
            echo "      Amount of t-shirt is : ".$this->tShirtAmount.PHP_EOL;
        }
        if ($this->pantsAmount > 0) {
            echo "      Amount of pants is : ".$this->pantsAmount.PHP_EOL;
        }
        if ($this->blanketAmount > 0) {
            echo "      Amount of blanket is : ".$this->blanketAmount.PHP_EOL;
        }
        if ($this->towelAmount > 0) {
            echo "      Amount of towel is : ".$this->towelAmount.PHP_EOL;
        }
        if ($this->underwareAmount > 0) {
            echo "      Amount of underware is : ".$this->underwareAmount.PHP_EOL;
        }
        echo <<<EOT
        \r\n[1] => Confirm infomation and check bill.\r\n[2] => Cancle and re-enter the information.\r\n
        EOT;
        $confirmOption = readline("");
        if ($confirmOption == "1") {
            $laundryList['shirtAmount'] = $this->shirtAmount;

            $laundryList['tShirtAmount'] = $this->tShirtAmount;

            $laundryList['pantsAmount'] = $this->pantsAmount;

            $laundryList['blanketAmount'] = $this->blanketAmount;

            $laundryList['towelAmount'] = $this->towelAmount;

            $laundryList['underwareAmount'] = $this->underwareAmount;
            $this->checkBill();
        } else {
            $this->laundry();
        }
    }

    function displayAmountError() {
        echo "\r\nPlease input only the number.\r\n";
    }

    function checkBill() {
        echo <<<EOT
        \r\nLaudry list.            Quality.            Price/Unit          Total\r\n
        EOT;
        foreach ($this->type as $type) {
            switch($type) {
                case "Shirt":
                    $this->totalPrices['totalShirt'] = $this->shirtAmount*$this->prices['shirt'];
                    echo $type."                        ".$this->shirtAmount."                      ".$this->prices['shirt']."             ".$this->totalPrices['totalShirt']." ฿\r\n";
                break;
                case "T-shirt":
                    $this->totalPrices['totalTShirt'] = $this->tShirtAmount*$this->prices['tShirt'];
                    echo $type."                      ".$this->tShirtAmount."                     ".$this->prices['tShirt']."            ".$this->totalPrices['totalTShirt']." ฿\r\n";
                break;
                case "Pants":
                    $this->totalPrices['totalPants'] = $this->pantsAmount*$this->prices['pants'];
                    echo $type."                        ".$this->pantsAmount."                     ".$this->prices['pants']."            ".$this->totalPrices['totalPants']." ฿\r\n";
                break;
                case "Blanket":
                    $this->totalPrices['totalBlanket'] = $this->blanketAmount*$this->prices['blanket'];
                    echo $type."                      ".$this->blanketAmount."                     ".$this->prices['blanket']."            ".$this->totalPrices['totalBlanket']." ฿\r\n";
                break;
                case "Towel":
                    $this->totalPrices['totalTowel'] = $this->towelAmount*$this->prices['towel'];
                    echo $type."                        ".$this->towelAmount."                     ".$this->prices['towel']."            ".$this->totalPrices['totalTowel']." ฿\r\n";
                break;
                case "Underware":
                    $this->totalPrices['totalUnderware'] = $this->underwareAmount*$this->prices['underware'];
                    echo $type."                    ".$this->underwareAmount."                      ".$this->prices['underware']."             ".$this->totalPrices['totalUnderware']." ฿\r\n";
                break;
            }
        }
                $total = 0;
                foreach ($this->totalPrices as $price) {
                    $total += $price;
                }
                echo "                                                          Total  ".$total." ฿\r\n";
    }

    function printSumary() {
        echo <<<EOT
        \r\nDo you want to export the summary the this laundry list as a pdf?\r\n
            [1] => Export.
            [2] => No thanks.\r\n
        EOT;
        $printSummaryOption = readline();
        if ($printSummaryOption == "1") {
            $this->report->exportPDF($this->customerName, $this->laundryList, $this->totalPrices);
        } else {
            echo "\r\nThanks for used our service.\r\nHope we can serve you again.\r\n";
        }
    }
}
?>