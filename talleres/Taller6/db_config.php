<?php
/* Clase que crea una coneción a la base de datos

*/
class DbConfig{
	private static $db_name = "cc500213_db";//Base de datos de la app
	private static $db_user = "cc500213_u";//Usuario MySQL
	private static $db_pass = "sUtuttur";//Password
	private static $db_host = "localhost";//Servidor donde esta alojado, puede ser 'localhost' o una IP (externa o interna).
	
	public static function getConnection(){
		$mysqli = new mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);

		$mysqli->set_charset("utf8"); //Muy importante!!
		return $mysqli;
	}
}
?>
