<?php
class IOfile {
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
        $this->readFile = fopen("config.txt","r");
        $this->getData();
    }

    function getData(){
        for($i=1;$i<=15;$i++){
            if($i==2){
                $this->shopName = trim(fgets($this->readFile));
            }
            else if($i==4){
                $this->shopAddress = trim(fgets($this->readFile));
            }
            else if($i==6){
                $this->shopTel = trim(fgets($this->readFile));
            }
            else if($i==8){
                $this->prices['Shirt'] = trim(fgets($this->readFile));
            }
            else if($i==9){
                $this->prices['T-shirt'] = trim(fgets($this->readFile));
            }
            else if($i==10){
                $this->prices['Pants'] = trim(fgets($this->readFile));
            }
            else if($i==11){
                $this->prices['Underware'] = trim(fgets($this->readFile));
            }
            else if($i==12){
                $this->prices['Towel'] = trim(fgets($this->readFile));
            }
            else if($i==13){
                $this->prices['Blanket'] = trim(fgets($this->readFile));
            }
            else if($i==15){
                $this->discountRate = trim(fgets($this->readFile));
            }
            else fgets($this->readFile);
        }
    }
}