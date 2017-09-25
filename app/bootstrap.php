<?php

require '../vendor/autoload.php';

$config = [
	'displayErrorDetails'               => true,
	'addContentLengthHeader'            => false,
	'determineRouteBeforeAppMiddleware' => true,
];

$container = new \Slim\Container($config);

$container['entityManager'] = function ($container) {
	$settings = include 'settings.php';

	$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
		$settings['doctrine']['meta']['entity_path'],
		$settings['doctrine']['meta']['auto_generate_proxies'],
		$settings['doctrine']['meta']['proxy_dir'],
		$settings['doctrine']['meta']['cache'],
		false
	);

	return \Doctrine\ORM\EntityManager::create($settings['doctrine']['connection'], $config);
};

$container['LicenseController'] = function ($container) {
	$vehicleResource = new \App\Models\Resource\VehicleResource($container->get('entityManager'));
	$tripResource    = new \App\Models\Resource\TripResource($container->get('entityManager'));
	$userResource    = new \App\Models\Resource\UserResource($container->get('entityManager'));

	return new App\Controllers\LicenseController($vehicleResource, $tripResource, $userResource);
};

$container['TripController'] = function ($container) {
	$tripResource    = new \App\Models\Resource\TripResource($container->get('entityManager'));
	$userResource    = new \App\Models\Resource\UserResource($container->get('entityManager'));

	return new App\Controllers\TripController($tripResource, $userResource);
};

$container['apiVersion'] = '0.1.0';

$app = new \Slim\App($container);
//$app->add(new App\Models\Middleware\TokenAuth($container));

require_once 'routes.php';