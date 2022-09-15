<html>
    <?php
    $user = 0;
    
    //SESION FACTURA
    session_start();
    
    
    ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title></title>
    </head>
    <body style="align-content: center"> 
     <?php echo '
        <script>
            window.fbAsyncInit = function () {
                FB.init({
                    appId: "207740953408218",
                    xfbml: true,
                    version: "v3.0"
                });
                FB.AppEvents.logPageView();
            };

            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, "script", "facebook-jssdk"));
        </script> '; ?>
    <fb:login-button 
        scope="public_profile,email"
        onlogin="checkLoginState();">
    </fb:login-button>
    <div style="align-self: center"
        class="fb-like"
        data-share="true"
        data-width="450"
        data-show-faces="true">
    </div>
    
    <pre style="background-image: url('./store/cajas.jpg'); text-align: center; border-color: black">
        <form id="boxes" method="POST" style="align-content: center">
            <center id="sidebar">
                <h3 style="font-weight: bold;color: black;font-style: italic">Usuario:</h3><br>
                <input type="text" name="name" style="width: 150pt; border-color: black;border-width: 2pt;align-content: center"><br>
                <h3 style="font-weight: bold; font-style: italic;color: black">Password:</h3><br>
                <input type="password" name="pass" style="width: 150pt; border-color: black;border-width: 2pt;"><br>
                <input type="submit" name="Iniciar" value="Iniciar" class="btn btn-primary"><br></br>
                <a href="register.php" class="btn btn-primary">Registrarse</a>
            </center>
        </form>
    </pre>
    <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>
    <?php
    if (isset($_REQUEST['Iniciar']) != FALSE) {
        $login = new login();
        $user = $_REQUEST['name'];
        $pass = $_REQUEST['pass'];

        $registros = $login->consulta($user);
        $user1 = $registros['nick'];
        $pass1 = $registros['pass'];
        $correo1= $registros['correo'];
        $nombre1= $registros['nombre'];

        if ($user1 == $user && $pass1 == $pass) {
           
            //SESION FACTURA
            $_SESSION['clientefac']=$nombre1;
            $_SESSION['correofac']=$correo1;
            //
            header('Location:index.php');
           
        
        } else {
            header('Location:login.php');
        }
    }

    class login {

        public function conexion() {
            $mysql =  new mysqli("localhost","root","","tiendacajas");

            if ($mysql->connect_error) {
                die("problemas con la conexion a la base de datos");
            }
            return $mysql;
        }

        public function cerrar() {
            $mysql = $this->conexion();
            $mysql->close();
        }

        public function consulta($user) {
            $mysql = $this->conexion();
            $registros = mysqli_fetch_assoc($mysql->query("SELECT nick,pass,nombre,correo FROM user WHERE nick ='$user'")) or die($mysql->error);
            return $registros;
        }

    }
    ?>
</body>
</html>
