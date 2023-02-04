<?php

require 'vendor/autoload.php';

//シークレットキー
\Stripe\Stripe::setApiKey('pk_test_51MWpIFJQMznoqScDBNjDogH8lDM0Guf7k2UHjQso19icxIXiC3CPddtS1NfHGwZMKl2UDUBCaR7HV9eobbYSUa7a00u5uHAjoK');

try {
    $stripeToken = $_POST['stripeToken'];

    $charge = \Stripe\Charge::create([
        'source' => $stripeToken,
        'amount' => 1000,
        'currency' => 'jpy',
    ]);
} catch (Error $e) {
    echo $e->getMessage();
}