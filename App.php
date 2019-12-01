<?php
require_once "Laundry.php";
$opts = getopt("lh", ['laundry', 'help'], $optind);
$laundry = new Laundry();

if (
    !array_key_exists('help', $opts)
    && array_key_exists('h', $opts)
)
    $opts['help'] = $opts['h'];

if (
    !array_key_exists('laundry', $opts)
    && array_key_exists('l', $opts)
)
    $opts['laundry'] = $opts['l'];

if (array_key_exists('help', $opts)) {
    displayHelp();
} else if (array_key_exists('laundry', $opts)) {
    echo <<<EOT


==================================================
||               LAUNDRY PROGRAM                ||
==================================================



\r\n\e[92m----------Laundry options.----------\e[0m \r\n
EOT;
$billPayment->payBill();
} else {
    displayError();
}

function displayHelp()
{
    echo <<<EOT


==================================================
||             BILL-PAYMENT PROGRAM             ||
==================================================



\r\nUsage:php app.php \e[92m[options]\e[0m
Options:

    Options                   Description

    \e[92m-l\e[0m | \e[92m--laundry\e[0m              Laundry options.
    \e[92m-h\e[0m | \e[92m--help\e[0m               Print this manual.                  
\r\n
EOT;
}

function displayError()
{
    echo <<<EOT
    
    \e[91mInvalid arguments!!!\e[0m \r\n
    Used the following command for usage information.
    \e[93mapp.php -h\e[0m


EOT;
}
