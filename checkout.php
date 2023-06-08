<?php

require_once('vendor/autoload.php');
//set your ow secret stripe api key
\Stripe\Stripe::setApiKey('sk_test_51N84G1BKJfv0FeeZzs8fIMvF8lvvdKwF9Zt795fHJHbycWaWO3u3cPxc3wTVpK4Xh5i9xKehX7GG4DTJ2p3Xi4LX00f6aHH7Up');

// Retrieve the token and amount from POST data
$token = $_POST['token'];
$amount = $_POST['bidAmount'];

// Create a charge using the token and amount
try {
    $charge = \Stripe\Charge::create([
        'amount' => $amount * 100, // Amount in cents
        'currency' => 'usd',
        'source' => $token,
        'description' => 'Payment for Bid'
    ]);
    echo 'Payment successful!';
} catch (\Stripe\Exception\CardException $e) {
    // Handle card errors
    echo 'Payment failed: ' . $e->getError()->message;
} catch (\Stripe\Exception\RateLimitException $e) {
    // Handle rate limit errors
    echo 'Payment failed: ' . $e->getError()->message;
} catch (\Stripe\Exception\InvalidRequestException $e) {
    // Handle invalid request errors
    echo 'Payment failed: ' . $e->getError()->message;
} catch (\Stripe\Exception\AuthenticationException $e) {
    // Handle authentication errors
    echo 'Payment failed: ' . $e->getError()->message;
} catch (\Stripe\Exception\ApiConnectionException $e) {
    // Handle network errors
    echo 'Payment failed: ' . $e->getError()->message;
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Handle other Stripe API errors
    echo 'Payment failed: ' . $e->getError()->message;
}
?>