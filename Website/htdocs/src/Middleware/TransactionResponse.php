<?php
/**
 * Created by PhpStorm.
 * User: kemal
 * Date: 25.06.18
 * Time: 11:33
 */

namespace App\Middleware;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\App;


class TransactionResponse
{
    /**
     * Holds the relevant settings
     * @var array
     */
    protected $settings;


    public function __construct(App $app)
    {
        $this->settings = $app->getContainer()['settings']['receiver'];
    }


    public function __invoke( Request $request, Response $response, callable  $next)
    {

    }

}