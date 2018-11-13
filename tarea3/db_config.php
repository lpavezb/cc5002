<?php
/* Clase que crea una coneción a la base de datos
* Modo de uso: 
$db = DbConfig::getConnection();
$sql = "SELECT id, nombre FROM region"
$result = $db->query($sql); 
$res = array();
while ($row = $result->fetch_assoc()) {
	$res[] = $row;
}
$db->close();
Resultados están en arreglo $res
*/
class DbConfig{
	private static $db_name = "cc500213_db";//Base de datos de la app
	private static $db_user = "cc500213_u";//Usuario MySQL
	private static $db_pass = "sUtuttur";//Password
	private static $db_host = "localhost";//Servidor donde esta alojado, puede ser 'localhost' o una IP (externa o interna).


	// private static $db_name = "tarea2";//Base de datos de la app
	// private static $db_user = "root";//Usuario MySQL
	// private static $db_pass = "password";//Password
	// private static $db_host = "127.0.0.1";//Servidor donde esta alojado, puede ser 'localhost' o una IP (externa o interna).
	
	public static function getConnection(){
		$mysqli = new mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);

		$mysqli->set_charset("utf8"); //Muy importante!!
		return $mysqli;
	}
}
?>
