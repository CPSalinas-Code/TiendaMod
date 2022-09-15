<?php

$conexion = new mysqli("localhost","root","","tiendacajas");

$query = $conexion->query("SELECT * FROM provincia");

echo '<option value="0">Seleccione</option>';

while ( $row = $query->fetch_assoc() )
{
	echo '<option value="' . $row['idProvincia']. '">' . $row['nombreProvincia'] . '</option>' . "\n";
}