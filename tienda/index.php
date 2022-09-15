<?php
/*
* Este archio muestra los productos en una tabla.
*/
session_start();
include "php/conection.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tienda el CAJAS</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
</head>
<body background="store/body-bg.gif">
<div class="container">
	<div class="row">
		<div class="col-md-12">
                    <h1>Tienda el Cajas</h1>                    
			<h2>Productos</h2>
                        <img src="store/logo.png" width="200">
                        <a href="http://localhost:9091/TestPrograWeb/faces/index.html" class="btn btn-info">El Cajas</a>
			<a href="./cart.php" class="btn btn-warning">Ver Carrito</a>
			<br><br>
<?php
/*
* Esta es la consula para obtener todos los productos de la base de datos.
*/
$products = $con->query("select * from product");
echo'<h2>'.$_SESSION['clientefac'].'<h2>'
?>
                        
<table class="table table-bordered">
<thead>
	<th>Producto</th>
	<th>Precio</th>
        <th>Imagen</th>
        <th>Descripcion</th>
	<th>Cantidad</th>
</thead>
<?php 
/*
* Apartir de aqui hacemos el recorrido de los productos obtenidos y los reflejamos en una tabla.
*/
while($r=$products->fetch_object()):?>
<tr>
    <td><pre><?php echo $r->name;?></pre></td>
    <td><pre>$ <?php echo $r->price; ?></pre></td>
        <td><img src="<?php echo $r->img; ?>"></td>
        <td><pre> <?php echo $r->descripcion; ?></pre></td>
	<td style="width:260px;">
	<?php
	$found = false;

	if(isset($_SESSION["cart"])){ foreach ($_SESSION["cart"] as $c) { if($c["product_id"]==$r->id){ $found=true; break; }}}
	?>
	<?php if($found):?>
		<a href="cart.php" class="btn btn-info">Agregado</a>
	<?php else:?>
	<form class="form-inline" method="post" action="./php/addtocart.php">
	<input type="hidden" name="product_id" value="<?php echo $r->id; ?>">
	  <div class="form-group">
	    <input type="number" name="q" value="1" style="width:100px;" min="1" class="form-control" placeholder="Cantidad">
	  </div>
	  <button type="submit" class="btn btn-primary">Agregar al carrito</button>
	</form>	
	<?php endif; ?>
	</td>
</tr>
<?php endwhile; ?>
</table>
<br><br><hr>

		</div>
	</div>
</div>
</body>
</html>
