<?php
/*
 * Este archio muestra los productos en una tabla.
 */
session_start();
include "php/conection.php";

$total=0; 
                                        
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    </head>
    <body background="store/body-bg.gif">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Tienda el Cajas</h1>                    
                    <img src="store/logo.png" width="200">
                    <a href="./index.php" class="btn btn-default">Productos</a>
                    <br><br>
                    <?php
                    /*
                     * Esta es la consula para obtener todos los productos de la base de datos.
                     */
                    $products = $con->query("select * from product");
                    if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])):
                        ?>
                        <table class="table table-bordered">
                            <thead>
                            <th>Cantidad</th>
                            <th>Producto</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                            <th></th>
                            </thead>
                            <?php
                            /*
                             * Apartir de aqui hacemos el recorrido de los productos obtenidos y los reflejamos en una tabla.
                             */
                            foreach ($_SESSION["cart"] as $c):
                                $products = $con->query("select * from product where id=$c[product_id]");
                                $r = $products->fetch_object();
                                ?>
                                <tr>
                                    <th><?php echo $c["q"]; ?></th>
                                    <td><?php echo $r->name; ?></td>
                                    <td>$ <?php
                                      echo $r->price;
                                        $total = $r->price*$c["q"] + $total;
                                        ?>
                                    </td>
                                    <td>$ <?php echo $c["q"] * $r->price; ?></td>
                                    <td style="width:260px;">
                                        <?php
                                        $found = false;
                                        foreach ($_SESSION["cart"] as $c) {
                                            if ($c["product_id"] == $r->id) {
                                                $found = true;
                                                break;
                                            }
                                        }
                                        ?>

                                        <a href="php/delfromcart.php?id=<?php echo $c["product_id"]; ?>" class="btn btn-danger">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; 
                            ?>
                                
                        </table>
                        <form class="form-horizontal" method="post" action="./php/process.php">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Total a pagar: </label>
                                <div class="col-sm-5">
                                <input type="text" name="tot" disabled="true" size="2" class="form-control" value="<?php echo $total; ?>"> Dolares Americanos.   
                                </div>
                            </div>
                        </form>  
                    
                  
                        <form class="form-horizontal" method="post" action="./php/process.php">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Informacion del Cliente</label>


                                <div class="col-sm-5">
<!--                               modificacion para factura-->
                                    <input type="text" name="email" required class="form-control" id="cliente" value="<?php echo $_SESSION['clientefac']; ?>">
                               
                                    <input type="text" name="nom" required class="form-control" id="clientecorreo" value="<?php echo $_SESSION['correofac']; ?>">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" href="./imprimir.php" class="btn btn-primary" onclick="window.print(); ">Procesar Venta</button>
<!--                                    <button type="submit" class="btn btn-primary" name="" value="Buscar" id="boton1" onclick = "funcion();">Procesar Venta</button>-->
                                    <a href="./imprimir.php" class="btn btn-warning">Enviar PDF</a>
                                  
                                   
                                </div>
                            </div>
                        </form>


                    <?php else: ?>
                        <p class="alert alert-warning">El carrito esta vacio.</p>
                    <?php endif; ?>
                    <br><br><hr>

                </div>
            </div>
        </div>
    </body>
</html>