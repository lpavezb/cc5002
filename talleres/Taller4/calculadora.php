<!DOCTYPE html>
<html>
	<head>
		<title>Calculadora</title>
		<meta charset="UTF-8">
	</head>
	<body>
		<h1>Calculadora</h1>
		<form action="calculadora.php" method="post">
			<select name="operador">
				<option value="suma">Suma</option>
				<option value="resta">Resta</option>
				<option value="multiplicacion">Multiplicación</option>
				<option value="division">División</option>
			</select><br />
			Ingresa tu primer número:<br />
			<input type="text" name="valor1"><br />
			Ingresa tu segundo valor:<br />
			<input type="text" name="valor2"><br>
			<input type="reset" value="Borrar">
			<input type="submit" value="Enviar">
		</form>
	</body>


</html>

