<?php
header('Content-Type: application/json; charset=utf-8');

require_once 'classes/Estoque.php';
require_once '../../MATRIZ/cliente.php';

class Rest
{
	public static function open($requisicao)
	{
		$url = explode('/', $requisicao['url']);

		$classe = ucfirst($url[0]);
		array_shift($url);

		$metodo = $url[1];
		array_shift($url);

		$parametros = array();
		$parametros = $url;

		try {
			if (class_exists($classe)) {
				if (method_exists($classe, $metodo)) {
					$retorno = call_user_func_array(array(new $classe, $metodo), $parametros);

					return json_encode(array('status' => 'sucesso', 'dados' => $retorno));
				} else {
					return json_encode(array('status' => 'erro', 'dados' => 'Método inexistente!'));
				}
			} else {
				return json_encode(array('status' => 'erro', 'dados' => 'Classe inexistente!'));
			}
		} catch (Exception $e) {
			return json_encode(array('status' => 'erro', 'dados' => $e->getMessage()));
		}
	}
}

if (isset($_REQUEST)) {
	echo Rest::open($_REQUEST);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <div class="corpo" style="background-color: #ccc; text-align: center;">
        <h1>Página principal do site da loja</h1>
    </div>
</body>

</html>