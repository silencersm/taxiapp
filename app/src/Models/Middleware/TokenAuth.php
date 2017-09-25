<?php

namespace App\Models\Middleware;

use \Psr\Http\Message\ServerRequestInterface;
use \Psr\Http\Message\ResponseInterface;
use \Slim\Container;


class TokenAuth
{
	/** @var  Container */
	private $_container;


	/**
	 * TokenAuth constructor.
	 *
	 * @param Container  $container  The DI container.
	 */
	public function __construct(Container $container) {
		$this->_container = $container;
	}


	/**
	 * Middleware invokable class
	 *
	 * @param ServerRequestInterface  $request   PSR7 request.
	 * @param ResponseInterface       $response  PSR7 response.
	 * @param callable                $next      Next middleware.
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
	{
		$token = null;

		if(isset($request->getHeader('Authorisation')[0])) {
			$token = $request->getHeader('Authorisation')[0];
		}

		if ($token && $this->_container->Users->validateToken($token)) {
			$this->_container->Users->updateUserToken($token);
		} else {
			return $response->withStatus(401, 'Unauthorized');

		}

		$response = $next($request, $response);

		return $response;
	}
}