<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Página registrado</title>
        <link rel="stylesheet" href="output.css" type="text/css">
    </head>
    <body class="h-screen bg-[url(5b792ce1080ada5be94dfb3acde27ba6.jpg)]">
<?php
    if(isset($_POST['nombre'])) {

        $nombre = $_POST['nombre'];
        $primerapellido = $_POST['primer_apellido'];
        $segundoapellido = $_POST['segundo_apellido'];
        $email =  $_POST['email'];
        $login = $_POST['login'];
        $clave = $_POST['clave'];
        $dato = $_POST['email'];
        $datoLogin = $_POST['login'];
        $campos = array();

        if($nombre == ""){
            array_push($campos, "Debes introducir tu nombre");
        }

        if($primerapellido == ""){
            array_push($campos, "Debes introducir tu primer apellido");
        }

        if($segundoapellido == ""){
            array_push($campos, "Debes introducir tu segubdo apellido");
        }

        if($email == "" || strpos($email, "@") === false){
            array_push($campos, "Debes introducir un correo electrónico válido");

        }

        if($login == ""){
            array_push($campos, "Debes crear un nombre de usuario");
        }

        if($clave == "" || strlen($clave) < 4 && strlen($clave) > 8 ){
            array_push($campos, "Debes introducir una contraseña entre 4 y 8 caracteres");
        }

        if(count($campos) > 0){
            echo "Por favor, rellena los campos";
            for($i = 0; $i < count($campos); $i++){
                echo "<li>" .$campos[$i]."</li>";
            }
        } else {
             //conexión bbdd  
             $servername = "localhost";
             $username = "root";
             $password = "";
             $dbname = "servidorcursosql";
          
             //crear conexion base datos
             $conexion = new mysqli($servername, $username, $password, $dbname);        
 
             if ($conexion->connect_error) {
                 die("Conexión fallida: ". $conexion->connect_error); 
             }

            $verificarDato = sprintf("SELECT email FROM usuarios WHERE email = '$dato'");

            $revisarDato = mysqli_query($conexion, $verificarDato);

            $nuevoDato = mysqli_num_rows($revisarDato);

            $verificarDatoLogin = sprintf("SELECT login FROM usuarios WHERE login = '$datoLogin'"); 

            $revisarDatoLogin = mysqli_query($conexion, $verificarDatoLogin);

            $nuevoDatoLogin = mysqli_num_rows($revisarDatoLogin);
 
            
            if($nuevoDatoLogin > 0) {
                echo '<script language="Javascript"> alert ("Este nombre de usuario ya ha sido registrado, por favor, usa otro.") </script>';
            } 

            if($nuevoDato > 0) {
                echo '<script language="Javascript"> alert ("Este correo ya ha sido registrado, por favor, usa otro correo.") </script>';
            }
            
            else {

            $sql = "INSERT INTO usuarios (NOMBRE, PRIMER_APELLIDO, SEGUNDO_APELLIDO, EMAIL, LOGIN, PASSWORD)
             VALUES ('$nombre', '$primerapellido', '$segundoapellido','$email', '$login', '$clave')";
 
            
             if ($conexion->query($sql) === TRUE) {
                 echo '<script language="Javascript"> alert (" tu registro se ha realizado de forma satisfactoria.") </script>';
             } else {
                 echo "Error: " . $sql . "<br>" . $conexion->error;
             }
 
             $conexion->close();
     
        }
    }

}          
?>
<br> <br>
<fieldset class="text-center font-serif font-medium text-3xl ">
<h2>¡Ups! Algo ha salido mal<h2> <br><br>
<p>
    Página en construcción. <br> <br> <br> Disculpa las molestias
</p>    
</fieldset>
<br> <br>
<div class="flex flex-col items-center ">
    <button class="bg-cyan-200 rounded-md text-md  border-2 border-black">
        <a class="font-medium font-serif" href="index.html" > Volver </a>
    </button>
</div>

</body>
</html>