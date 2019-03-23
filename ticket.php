<?php

try {
    $tickets = file_get_contents('http://localhost/php-casetickets/server-php/?path=');

} catch (\Throwable $th) {
    $tickets ="Erro.";
}

$tickets = json_decode($tickets, true);
