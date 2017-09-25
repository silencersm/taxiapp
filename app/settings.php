<?php

return [
	'doctrine' => [
		'meta' => [
			'entity_path' => [
				'app/src/Models/Entity'
			],
			'auto_generate_proxies' => true,
			'proxy_dir' =>  __DIR__.'/../cache/proxies',
			'cache' => null,
		],
		'connection' => [
			'driver'   => 'pdo_mysql',
			'host'     => 'localhost',
			'dbname'   => 'taxiapp',
			'user'     => 'xxxx',
			'password' => 'xxxx',
		]
	]
];