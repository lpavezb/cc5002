<!DOCTYPE html>
	<html>
	    <head>
	        <title>Taller 1</title>
	       
			<meta charset="utf-8">
	    </head>
	    <body>
	        <h1 style="color: red" >Arma tu pizza</h1>
	        <form method="POST" action="taller1.php">
	        	Nombre: <input type="text" name="nombre" size="20" id="nombre"><br>
	        	Telefono: <input type="text" name="telefono" size="20" id="telefono"><br>
	        	Dirección: <input type="text" name="direccion" size="30" id="direccion"><br>
	        	Comuna: 
	        	<select>
	        		<option>Santiago</option>
	        		<option>Providencia</option>
	        		<option>Recoleta</option>
	        	</select>
	        	<br>
	        	Tipo de Masa:<br>
	        		<input type="radio" name="masa"	id="delgada" value="1">Delgada
	        		<input type="radio" name="masa" id="gruesa" value="2">Gruesa
	        	<br>
	        	Ingredientes:<br>
	        	Pepperoni<input type="checkbox" name="ingredientes2[]" value="1" />
				Aceituna<input type="checkbox" name="ingredientes2[]" value="2" />
				Carne<input type="checkbox" name="ingredientes2[]" value="3" /><br>
	        	Comentarios:
	        	<textarea id="comentario" name="comentario" cols="40" rows="10"></textarea><br>
	        	Costo: <p id="costo"></p><br>
	        	<button type="submit">Enviar</button>
	        	<button type="reset">Limpiar Formulario</button>
	        </form>
	    </body>
	</html>