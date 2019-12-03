<?php
require_once "IOfile.php";
class Payment {
    public $receivedMoney;
    public $change;
    public $totalPrice;
    public $discountPrice;
    private $discountRate;
    private $data;

    function __construct()
    {
        $this->data = new IOfile();
        $this->receivedMoney = 0;
        $this->totalPrice = 0;
        $this->change = 0;
        $this->discountPrice = 0;
        $this->discountRate = $this->data->discountRate/100;
    }

    function receiveMoney() {
        $inputData = readline("\r\nInput the amount of money.\r\n");
        if (preg_match('/^[0-9]+$/', $inputData)) {
            $this->receivedMoney = (int)$inputData;
            echo "\r\nReceived ".number_format((float)$this->receivedMoney, 2, '.', '')." Baht from the customer.\r\n";
        } else {
            echo "\r\n\e[31mInvalid input data\e[0m\r\nPlease input a number only.\r\n";
            $this->receiveMoney();
        }
    }

    function calculation() {
        $this->receiveMoney();
        if ($this->totalPrice > $this->receivedMoney) {
            echo "\r\n\e[31mReceived money is less the the total amount.\e[0m\r\nPlease input again.\r\n";
            $this->calculation($this->totalPrice);
        } else {
            $this->change = $this->receivedMoney - $this->totalPrice;
            echo "\r\n\t\t\t\t\t\t\t\t\t\t\tChange is ".number_format((float)$this->change, 2, '.', '')." Baht.\r\n";
        }
    }

    function getDiscount($totalPrice) {
        $this->totalPrice = $totalPrice;
        echo "\r\nIs member is the member of laundry shop?\r\n";
        echo <<<EOT
            [1] => Yes.
            [2] => No.\r\n
        EOT;
        $inputData = readline();
        if ($inputData == "1") {
            $this->discountPrice = $this->totalPrice*$this->discountRate;
            $this->totalPrice = $this->totalPrice - $this->discountPrice;
            $this->discountRate = $this->discountRate*100;
            echo "\r\nApplied ".$this->discountRate."% discount from total price.\r\n";
            echo "\t\t\t\t\t\t\t\t\t\t\tTotal  ".number_format((float)$this->totalPrice, 2, '.', '')." ฿\r\n";
            $this->calculation();
        } else {
            echo "\r\nCalculate the total price using normal rate.\r\n";
            echo "\t\t\t\t\t\t\t\t\t\t\tTotal  ".number_format((float)$this->totalPrice, 2, '.', '')." ฿\r\n";
            $this->calculation();
        }
    }
}
