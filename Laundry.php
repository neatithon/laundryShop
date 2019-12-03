<?php
require_once "Report.php";
require_once "Payment.php";
require_once "IOfile.php";
class Laundry {
    private $prices;
    private $laundryList;
    private $totalPrices;
    private $customerName;
    private $customerNumber;
    private $shirtAmount;
    private $tShirtAmount;
    private $pantsAmount;
    private $blanketAmount;
    private $underwareAmount;
    private $towelAmount;
    private $type;
    private $report;
    private $payment;
    private $data;

    function __construct()
    {
        $this->report = new Report();
        $this->payment = new Payment();
        $this->data = new IOfile();
        $this->totalPrices = [];
        $this->type = ["Shirt", "T-shirt", "Pants", "Blanket", "Towel", "Underware"];
        $this->prices['Shirt'] = (int)$this->data->prices['Shirt'];
        $this->prices['T-shirt'] = (int)$this->data->prices['T-shirt'];
        $this->prices['Pants'] = (int)$this->data->prices['Pants'];
        $this->prices['Blanket'] = (int)$this->data->prices['Blanket'];
        $this->prices['Underware'] = (int)$this->data->prices['Underware'];
        $this->prices['Towel'] = (int)$this->data->prices['Towel'];
        // $this->prices['Shirt'] = 5;
        // $this->prices['T-shirt'] = 10;
        // $this->prices['Pants'] = 10;
        // $this->prices['Blanket'] = 50;
        // $this->prices['Underware'] = 3;
        // $this->prices['Towel'] = 20;
    }

    function laundry() {
        $this->getCustomerName();
        $this->getCustomerNumber();
        echo "\r\nEnter the amount of laundry list.\r\n(Input 0 if no shirt)\r\n";
        $this->getShirtAmount();
        $this->getTShirtAmount();
        $this->getPantsAmount();
        $this->getBlanketAmount();
        $this->getTowelAmount();
        $this->getUnderwareAmount();
        $this->printInputtedInfo();
    }

    function getCustomerName() {
        $inputData = readline("\r\nInput the customer name.\t\t\t\t\t\t");
        if (strlen($inputData) == 0) {
            echo "\r\nPlease input the customer name again.\r\n";
            $this->getCustomerName();
        } else {
            $this->customerName = $inputData;
        }
    }

    function getCustomerNumber() {
        //$inputData = readline("\r\nInput the phone number.\t\t");
        echo "\r\nInput the phone number.\t\t";
        fscanf(STDIN,"%s",$inputData);
        if (strlen($inputData) != 10 && preg_match('/^[0-9]+$/', $inputData)) {
            echo "\r\n\e[31mYou have inputted a wrong format!!\e[0m";
            echo "\r\nPlease input the customer number again.\r\n";
            $this->getCustomerNumber();
        } else {
            preg_match( '/^(\d{3})(\d{3})(\d{4})$/', $inputData,  $splited );
            $this->customerNumber = $splited[1]."-".$splited[2]."-".$splited[3];
        }
    }

    function getShirtAmount() {
        //$inputData = readline("Shirts :\t\t");
        echo "Shirts :\t\t";
        fscanf(STDIN,"%d",$inputData);
        if (preg_match('/^[0-9]+$/', $inputData)) {
            $this->shirtAmount = (int)$inputData;
        } else {
            $this->displayAmountError();
            $this->getShirtAmount();
        }
    }

    function getTShirtAmount() {
        // $inputData = readline("T-shirts :\t\t");
        echo "T-shirts :\t\t";
        fscanf(STDIN,"%d",$inputData);
        if (preg_match('/^[0-9]+$/', $inputData)) {
            $this->tShirtAmount = (int)$inputData;
        } else {
            $this->displayAmountError();
            $this->getTShirtAmount();
        }
    }

    function getPantsAmount() {
        // $inputData = readline("Pants :\t\t\t");
        echo "Pants :\t\t\t";
        fscanf(STDIN,"%d",$inputData);
        if (preg_match('/^[0-9]+$/', $inputData)) {
            $this->pantsAmount = (int)$inputData;
        } else {
            $this->displayAmountError();
            $this->getPantsAmount();
        }
    }

    function getBlanketAmount() {
        // $inputData = readline("Blanket :\t\t");
        echo "Blanket :\t\t";
        fscanf(STDIN,"%d",$inputData);
        if (preg_match('/^[0-9]+$/', $inputData)) {
            $this->blanketAmount = (int)$inputData;
        } else {
            $this->displayAmountError();
            $this->getBlanketAmount();
        }
    }

    function getUnderwareAmount() {
        //$inputData = readline("Underware :\t\t");
        echo "Underware :\t\t";
        fscanf(STDIN,"%d",$inputData);
        if (preg_match('/^[0-9]+$/', $inputData)) {
            $this->underwareAmount = (int)$inputData;
        } else {
            $this->displayAmountError();
            $this->getUnderwareAmount();
        }
    }

    function getTowelAmount() {
        //$inputData = readline("Towel :\t\t\t");
        echo "Towel :\t\t\t";
        fscanf(STDIN,"%d",$inputData);
        if (preg_match('/^[0-9]+$/', $inputData)) {
            $this->towelAmount = (int)$inputData;
        } else {
            $this->displayAmountError();
            $this->getTowelAmount();
        }
    }

    function printInputtedInfo() {
        echo "\r\nDo you want to check bill the following summary?\r\n".PHP_EOL;
        echo "      Customer name is :\t".$this->customerName.PHP_EOL;
        if ($this->shirtAmount > 0) {
            echo "      Amount of shirt is :\t".$this->shirtAmount.PHP_EOL;
        }
        if ($this->tShirtAmount > 0) {
            echo "      Amount of t-shirt is :\t".$this->tShirtAmount.PHP_EOL;
        }
        if ($this->pantsAmount > 0) {
            echo "      Amount of pants is :\t".$this->pantsAmount.PHP_EOL;
        }
        if ($this->blanketAmount > 0) {
            echo "      Amount of blanket is :\t".$this->blanketAmount.PHP_EOL;
        }
        if ($this->towelAmount > 0) {
            echo "      Amount of towel is :\t".$this->towelAmount.PHP_EOL;
        }
        if ($this->underwareAmount > 0) {
            echo "      Amount of underware is :\t".$this->underwareAmount.PHP_EOL;
        }
        echo <<<EOT
        \r\n[1] => Confirm infomation and check bill.\r\n[2] => Cancle and re-enter the information.\r\n
        EOT;
        // $confirmOption = readline("");
        fscanf(STDIN,"%s",$confirmOption);
        if ($confirmOption == "1") {
            $this->laundryList['Shirt'] = $this->shirtAmount;

            $this->laundryList['T-shirt'] = $this->tShirtAmount;

            $this->laundryList['Pants'] = $this->pantsAmount;

            $this->laundryList['Blanket'] = $this->blanketAmount;

            $this->laundryList['Towel'] = $this->towelAmount;

            $this->laundryList['Underware'] = $this->underwareAmount;
            $this->checkBill();
        } else if ($confirmOption == "2") {
            $this->laundry();
        } else {
            $this->displayWrongChoices();
            $this->printInputtedInfo();
        }
    }

    function displayAmountError() {
        echo "\r\nPlease input only the number.\r\n";
    }

    function checkBill() {
        echo <<<EOT
        \r\nLaudry list.\t\t\tQuality.\t\t\tPrice/Unit\t\t\tTotal\r\n
        EOT;
        foreach ($this->type as $type) {
            switch($type) {
                case "Shirt":
                    $this->totalPrices['Shirt'] = $this->shirtAmount*$this->prices['Shirt'];
                    echo $type."\t\t\t\t\t".$this->shirtAmount."\t\t\t\t".$this->prices['Shirt']."\t\t\t".number_format((float)$this->totalPrices['Shirt'], 2, '.', '')." ฿\r\n";
                break;
                case "T-shirt":
                    $this->totalPrices['T-shirt'] = $this->tShirtAmount*$this->prices['T-shirt'];
                    echo $type."\t\t\t\t\t".$this->tShirtAmount."\t\t\t\t".$this->prices['T-shirt']."\t\t\t".number_format((float)$this->totalPrices['T-shirt'], 2, '.', '')." ฿\r\n";
                break;
                case "Pants":
                    $this->totalPrices['Pants'] = $this->pantsAmount*$this->prices['Pants'];
                    echo $type."\t\t\t\t\t".$this->pantsAmount."\t\t\t\t".$this->prices['Pants']."\t\t\t".number_format((float)$this->totalPrices['Pants'], 2, '.', '')." ฿\r\n";
                break;
                case "Blanket":
                    $this->totalPrices['Blanket'] = $this->blanketAmount*$this->prices['Blanket'];
                    echo $type."\t\t\t\t\t".$this->blanketAmount."\t\t\t\t".$this->prices['Blanket']."\t\t\t".number_format((float)$this->totalPrices['Blanket'], 2, '.', '')." ฿\r\n";
                break;
                case "Towel":
                    $this->totalPrices['Towel'] = $this->towelAmount*$this->prices['Towel'];
                    echo $type."\t\t\t\t\t".$this->towelAmount."\t\t\t\t".$this->prices['Towel']."\t\t\t".number_format((float)$this->totalPrices['Towel'], 2, '.', '')." ฿\r\n";
                break;
                case "Underware":
                    $this->totalPrices['Underware'] = $this->underwareAmount*$this->prices['Underware'];
                    echo $type."\t\t\t\t".$this->underwareAmount."\t\t\t\t".$this->prices['Underware']."\t\t\t".number_format((float)$this->totalPrices['Underware'], 2, '.', '')." ฿\r\n";
                break;
            }
        }
                $totalPrice = 0;
                foreach ($this->totalPrices as $price) {
                    $totalPrice += $price;
                }

        echo "\t\t\t\t\t\t\t\t\t\t\tTotal  ".number_format((float)$totalPrice, 2, '.', '')." ฿\r\n";

        $this->payment->getDiscount($totalPrice);
        $this->printSumary();

    }

    function printSumary() {
        echo <<<EOT
        \r\nDo you want to export the summary the this laundry list as a pdf?\r\n
            [1] => Export.
            [2] => No thanks.\r\n
        EOT;
        $printSummaryOption = readline();
        if ($printSummaryOption == "1") {
            $this->report->exportPDF($this->customerName, $this->customerNumber, $this->type, $this->laundryList, $this->prices, $this->totalPrices, $this->payment->receivedMoney, $this->payment->change, $this->payment->discountPrice, $this->payment->totalPrice);
            echo "\r\nThanks for used our service.\r\nHope we can serve you again.\r\n";
        } else if ($printSummaryOption == "2") {
            echo "\r\nThanks for used our service.\r\nHope we can serve you again.\r\n";
        } else {
            $this->displayWrongChoices();
            $this->printSumary();
        }
    }

    function displayWrongChoices() {
        echo "\r\n\e[31mPlease input only provided choices\e[0m\r\n";
    }

}
?>