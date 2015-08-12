<?php

require_once 'vendor/autoload.php';

use Reader\MyCSVReader;
use Templating\TemplateEngine;
use Mailer\MyMailer;
use Validator\Validator;

define(EMAIL_ACCOUNT, ''); // provide your email account for access to the google smpt server
define(EMAIL_PASSWORD, ''); // provide your email account password

$csvReader = MyCSVReader::createFromPath('exchgRates.csv');
$csvReader->setDelimiter(';');


$currencyCodes = $csvReader->fetchColumn(1);
$purchasePrices = $csvReader->fetchColumn(3);
$trimmedCurrencyCodes = $csvReader->trimCSVData($currencyCodes, 8);
$trimmedPurchasePrices = $csvReader->trimCSVData($purchasePrices, 8);
array_walk($trimmedPurchasePrices, function(&$value, $key) {
    $value = round($value, 2);
});

$dataReference = array_combine($trimmedCurrencyCodes, $trimmedPurchasePrices);

$flashMessage = null;

if (isset($_POST['email'])) {
    $dataValidator = new Validator($dataReference);
    if (handleRequest($_POST, $dataValidator)) {
        $flashMessage = 'Email został wysłany';
    } else {
        $flashMessage = 'Email NIE został wysłany';
    }
}

function handleRequest($request, $dataValidator)
{
    if ($dataValidator->validateData($request) &&
        $dataValidator->validateCondition($request)) {
            $mailer = new MyMailer();
            $transport = $mailer->configureTransport(
                                    'smtp.gmail.com',
                                    465,
                                    'ssl',
                                    EMAIL_ACCOUNT,
                                    EMAIL_PASSWORD);
            $message = $mailer->setMessage($request['email'], 'Czas na zakup waluty!');

            return $mailer->sendNotification($transport, $message);

    }

    return false;
}

$baseTemplate = new TemplateEngine('views/base.php');
$baseTemplate->data = $dataReference;
$baseTemplate->flashMessage = $flashMessage;


echo $baseTemplate;

