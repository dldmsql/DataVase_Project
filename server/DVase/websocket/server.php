<?php
	use Ratchet\Server\IoServer;
	use Ratchet\Http\HttpServer;
	use Ratchet\WebSocket\WsServer;

	require "../vendor/autoload.php";
	require "./websck.php";

	use Module\WS;

	$server = IoServer::factory(
		new HttpServer(
			new WsServer(
				new WS()
			)
		)
	  , 8000
	);

	$server->run();