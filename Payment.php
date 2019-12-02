<?php
class Payment {
    public $receivedMoney;

    function __construct()
    {
        $this->receivedMoney = 0;
    }

    function receiveMoney() {
        $inputData = readline("\r\nPlease input the amount of money.\r\n");
        if (preg_match('/^[0-9]+$/', $inputData)) {
            $this->receivedMoney = $inputData;
            echo "\r\nReceive ".$this->receivedMoney." Baht from the customer.\r\n";
        } else {
            echo "\r\n\e[31mInvalid input data\e[0m\r\nPlease input a number only.\r\n";
            $this->receiveMoney();
        }
    }
}
?>