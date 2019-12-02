<?php
class Payment {
    public $receivedMoney;
    public $change;
    public $totalPrice;
    public $discountPrice;

    function __construct()
    {
        $this->receivedMoney = 0;
        $this->totalPrice = 0;
        $this->change = 0;
        $this->discountPrice = 0;
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

    function calculation($totalPrice) {
        $this->totalPrice = $totalPrice;
        $this->receiveMoney();
        if ($this->totalPrice > $this->receivedMoney) {
            echo "\r\n\e[31mReceived money is less the the total amount.\e[0m\r\nPlease input again.\r\n";
            $this->calculation($this->totalPrice);
        } else {
            $this->getDiscount();
            $this->change = $this->receivedMoney - $this->totalPrice;
            echo "\r\nChange is ".number_format((float)$this->change, 2, '.', '')." Baht.\r\n";
        }
    }

    function getDiscount() {
        echo "\r\nIs member is the member of laundry shop?\r\n";
        echo <<<EOT
            [1] => Yes.
            [2] => No.\r\n
        EOT;
        $inputData = readline();
        if ($inputData == "1") {
            echo "\r\nApplied 10% discount from total price.\r\n";
            $this->discountPrice = $this->totalPrice*0.1;
            $this->totalPrice = $this->totalPrice - $this->discountPrice;
        } else {
            echo "\r\nCalculate the total price using normal rate.\r\n";
        }
    }
}
?>