<?php
// # GetAuthorization
// This sample code demonstrates how you can get details 
// of an authorized payment.
// API used: /v1/payments/authorization/<$authorizationId>

/** @var Authorization $authorization */
$authorization = require 'AuthorizePayment.php';

use PayPal\Api\Authorization;
use PayPal\Api\Payment;

// ### GetAuthorization
// You can retrieve info about an Authorization
// by invoking the Authorization::get method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The return object contains the authorization state.

try {
    // Retrieve the authorization
    $result = Authorization::get($authorization->getId(), $apiContext);
} catch (Exception $ex) {
    ResultPrinter::printError("Get Authorization", "Authorization", null, null, $ex);
    exit(1);
}

ResultPrinter::printResult("Get Authorization", "Authorization", $authorization->getId(), null, $result);

return $authorization;
