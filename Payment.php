<?php
class Payment {
    public $receivedMoney;
    public $change;

    function __construct()
    {
        $this->receivedMoney = 0;
    }

    function receiveMoney() {
        $inputData = readline("\r\nInput the amount of money.\r\n");
        if (preg_match('/^[0-9]+$/', $inputData)) {
            $this->receivedMoney = (int)$inputData;
            echo "\r\nReceived ".$this->receivedMoney." Baht from the customer.\r\n";
        } else {
            echo "\r\n\e[31mInvalid input data\e[0m\r\nPlease input a number only.\r\n";
            $this->receiveMoney();
        }
    }

    function calculation($totalPrice) {
        $this->receiveMoney();
        if ($totalPrice > $this->receivedMoney) {
            echo "\r\n\e[31mReceived money is less the the total amount.\e[0m\r\nPlease input again.\r\n";
        } else {
            $this->change = $this->receivedMoney - $totalPrice;
            echo "\r\nChange is ".$this->change." Baht.\r\n";
        }
    }
}
?>