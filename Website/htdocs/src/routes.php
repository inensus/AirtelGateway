<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/', function (Request $request, Response $response) {
    echo "Welcome to airtel gateway";
});
// Routes
$app->post('/api/transactions/airtel', function (Request $request, Response $response, array $args) {
    $this->logger->info("Transaction",
        [
            'sender' => $request->getServerParam('REMOTE_ADDR'),
            'data' => $request->getParsedBody(),
            'raw_data' => $request->getBody()->getContents(),
        ]);

    $mainApi = $this->get('settings')['mainAPi'];

    $client = new GuzzleHttp\Client();
    $api_request = $client->post($mainApi['sendUrl'], [
        'headers' => [
            'Content-Type: tex/xml',
            'Connection: Keep-Alive',
        ],
        'body' => $request->getBody(),
    ]);
    echo $api_request->getBody();


})->add(new \App\Middleware\Transaction($app));

//airtel transactions are automatically confirmed
//thus, this will only be used for cancel transactions

$app->post('/api/transactions/airtel/sendResult', function (Request $request, Response $response, Array $args) {
    $this->logger->info("Transaction Result", [
        'sender' => $request->getServerParam('REMOTE_ADDR'),
        'data' => $request->getParsedBody(),
        'raw_data' => $request->getBody()->getContents(),
    ]);

    $airtel = $this->get('settings')['airtel'];

    $client = new GuzzleHttp\Client();
    //cancellation request
    $airtel_request = $client->post($airtel['transactionUrl'], [
        'headers' => [
            'Content-Type: tex/xml',
            'Connection: Keep-Alive',
        ],
        'body' => $request->getBody(),
    ]);
    echo $airtel_request->getBody();
});

