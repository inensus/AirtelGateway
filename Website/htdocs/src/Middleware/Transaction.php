<?php
/**
 * Created by PhpStorm.
 * User: kemal
 * Date: 15.06.18
 * Time: 15:27
 */

namespace App\Middleware;

use Slim\App;

class Transaction
{
    /**
     * Holds the Transaction settings
     * @var array
     */
    protected $transactionSettings;

    public function __construct(App $app)
    {
        $this->transactionSettings = $app->getContainer()['settings']['airtel'];
    }


    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request PSR7 request
     * @param \Psr\Http\Message\ResponseInterface $response PSR7 response
     * @param callable $next Next middleware
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(
        \Psr\Http\Message\ServerRequestInterface $request,
        \Psr\Http\Message\ResponseInterface $response,
        callable $next
    ) {
        if (in_array($request->getServerParams()['REMOTE_ADDR'], $this->transactionSettings['ips'])) {
            return $next($request, $response);
        } else {
            echo "dying";
            die;
        }
    }
}