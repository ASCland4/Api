<?php

$url = 'http://localhost/api/v1/classes';

$classe = 'estoque';
$metodo = 'mostrar';

$montar = $url . '/' . $classe . '/' . $metodo;

$retorno = file_get_contents($montar);

var_dump(json_decode($retorno, 1));