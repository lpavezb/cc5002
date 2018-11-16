<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<h1>Pregunta 3 Taller 6</h1>
		<form action="savecookie.php" method="post">
	<p>
		Username: <input name="username" type="text" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>" class="input-field">
	</p>
		 <p>Password: <input name="password" type="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" class="input-field">
	</p>
		<p><input type="checkbox" name="remember" /> Remember me
	</p>
		<p><input type="submit" value="Login"></span></p>       
</form>
	</body>
</html>

