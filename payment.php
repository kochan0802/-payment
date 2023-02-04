<?php
  // Stripeライブラリをロード
  require_once('/vendor/autoload.php');

  // Secret API keyをセット
  \Stripe\Stripe::setApiKey("pk_test_51MWpIFJQMznoqScDBNjDogH8lDM0Guf7k2UHjQso19icxIXiC3CPddtS1NfHGwZMKl2UDUBCaR7HV9eobbYSUa7a00u5uHAjoK");

  $s=\Stripe\Checkout\Session::create([
    'success_url' => 'https://example.com/success.php',
    'cancel_url' => 'https://example.com/cancel.php',
    'payment_method_types' => ['card'],
    'line_items' => [[
    'amount' => 500,
    'currency' => 'usd',
    'name' => 'sample商品',
    'description' => 'Stripeテスト決済',
    'quantity' => 1,
  ]]
]);
$id=$s['id'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://js.stripe.com/v3/"></script>
</head>
<body>
