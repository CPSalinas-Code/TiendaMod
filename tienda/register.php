<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
        <title>Registro</title>
        <?php
        $nombre = "";
        $direccion = "";
        $correo = "";
        $provincia = "";
        $contrasenia = "";
        $canton = "";
        $nick = "";
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  
  <script src="functions.js"></script>';
        ?>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <pre style="background-image: url('./store/cajas.jpg');text-align: center">
        <form method="POST">
            <center id="sidebar">
          <div class="dark">
              <h1 style="font-weight: bold">REGISTRO</h1>
                <h3 style="font-weight: bold;color: black;font-style: italic">Nombre: </h3>
                <input style="align-self: center;border-color: black;border-width: 2;width: 150pt" type="text" name="nombre">
                <h3 style="font-weight: bold;color: black;font-style: italic">Correo:</h3>
                <input style="align-self: center;border-color: black;border-width: 2;width: 150pt" type="text" name="correo">
                <h3 style="font-weight: bold;color: black;font-style: italic">Provincia</h3>
                <select name="provincia" id="provincia">
                    <option style="align-self: center;border-color: black;border-width: 2;width: 150pt;font-size: 15" value="0">Seleccione</option>
                </select>
                <h3 style="font-weight: bold;color: black;font-style: italic">Canton </h3>
                <select name="ciudad" id="ciudad">
                    <option style="align-self: center;border-color: black;border-width: 2;width: 150pt" value="0">Cargando...</option>
                </select>
                <h3 style="font-weight: bold;color: black;font-style: italic">Nick: </h3>
                <input style="align-self: center;border-color: black;border-width: 2;width: 150pt" type="text" name="name">
                <h3 style="font-weight: bold;color: black;font-style: italic">Contrasenia: </h3>
                <input style="align-self: center;border-color: black;border-width: 2;width: 150pt" type="password" name="pass">
            </div><br>
            <input type="submit" name="iniciar" value="Iniciar" class="btn btn-primary"><br></br>
            
            
            </center>
        </form>
        </pre>
        <?php
        $objeto = new register();
        $objeto->conexion();
        if (isset($_REQUEST['iniciar']) != FALSE) {
            $nombre = $_REQUEST['nombre'];
            $correo = $_REQUEST['correo'];
            $contrasenia = $_REQUEST['pass'];
            $canton = $_REQUEST['ciudad'];
            $nick = $_REQUEST['name'];
            $objeto->consultar($nick, $nombre, $correo, $contrasenia, $canton);
            echo 'Se ha agregado un nuevo rubro';
        }

        class register {

            public function conexion() {
                $mysql = new mysqli("localhost","root","","tiendacajas");
                if ($mysql->connect_error) {
                    die("problemas con la conexion a la base de datos");
                }
                return $mysql;
            }

            public function cerrar() {
                $mysql = $this->conexion();
                $mysql->close();
            }

            public function consultar($nick, $nombre, $correo, $contrasenia, $canton) {
                $mysql = $this->conexion();
                $mysql->query("INSERT INTO user (id, nombre, correo, nick, pass, ciudad_idCiudad)"
                                . " VALUES ('', '$nombre', '$correo','$nick', '$contrasenia', '$canton')") or die($mysql->error);
            }

        }
        ?>

    </body>
</html>