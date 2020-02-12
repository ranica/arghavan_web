<?php

/*
 *  Routes for WebSocket
 *
 * Add route (Symfony Routing Component)
 * $socket->route('/myclass', new MyClass, ['*']);
 */

$socket->route('/GateServer',
               new \App\Http\Sockets\GateServer,
               ['*']);
