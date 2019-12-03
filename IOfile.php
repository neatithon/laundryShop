<?php
class IOfile
{
    private $fileName;
    private $readFile;
    public $shopName;
    public $shopAddress;
    public $shopTel;
    public $prices;
    public $discountRate;

    function __construct()
    {
        $this->prices = [];
        $this->fileName = "config.txt";
        $this->readFile = fopen($this->fileName, "r");
        $this->getData();
    }

    function getData()
    {
        for ($i = 1; $i <= 15; $i++) {
            if ($i == 2) {
                $this->shopName = trim(fgets($this->readFile));
            } else if ($i == 4) {
                $this->shopAddress = trim(fgets($this->readFile));
            } else if ($i == 6) {
                $this->shopTel = trim(fgets($this->readFile));
            } else if ($i == 8) {
                $text = trim(fgets($this->readFile));
                $position = strpos($text, " = ");
                $this->prices['Shirt'] = substr($text, 0, $position);
            } else if ($i == 9) {
                $text = trim(fgets($this->readFile));
                $position = strpos($text, " = ");
                $this->prices['T-shirt'] = substr($text, 0, $position);
            } else if ($i == 10) {
                $text = trim(fgets($this->readFile));
                $position = strpos($text, " = ");
                $this->prices['Pants'] = substr($text, 0, $position);
            } else if ($i == 11) {
                $text = trim(fgets($this->readFile));
                $position = strpos($text, " = ");
                $this->prices['Underware'] = substr($text, 0, $position);
            } else if ($i == 12) {
                $text = trim(fgets($this->readFile));
                $position = strpos($text, " = ");
                $this->prices['Towel'] = substr($text, 0, $position);
            } else if ($i == 13) {
                $text = trim(fgets($this->readFile));
                $position = strpos($text, " = ");
                $this->prices['Blanket'] = substr($text, 0, $position);
            } else if ($i == 15) {
                $this->discountRate = trim(fgets($this->readFile));
            } else fgets($this->readFile);
        }
        fclose($this->readFile);
    }
}
