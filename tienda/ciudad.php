<?php

$conexion = new mysqli("localhost","root","","tiendacajas");

$provincia = $_POST['provincia'];

$query = $conexion->query("SELECT * FROM ciudad WHERE provincia_idProvincia = $provincia");

echo '<option value="0">Seleccione</option>';

while ( $row = $query->fetch_assoc() )
{
	echo '<option value="' . $row['idCiudad']. '">' . $row['nombreCiudad'] . '</option>' . "\n";
}
