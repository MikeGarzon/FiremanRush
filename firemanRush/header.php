<?php
    $servidor = "localhost";
    $baseDatos = "firemanrushdb";
    $usuario = "root";
    $pass = "pass";

    $conn  = mysqli_connect($servidor, $usuario, $pass, $baseDatos);

    if (!$conn){
        echo "Error intentando conectar a la base de datos";
    }else{
        echo "Conectado correctamente a la base de datos....";

        if (isset($_GET['username'])  && isset($_GET['password']) && isset($_GET['score'])){

            $username = $_GET['username'];
            $password = $_GET['password'];
            $score = $_GET['score'];
    
    
            $sqli = "INSERT INTO `users` (`username`, `password`, `score`)
                VALUES ('".$username."', '".$password."', '".$score."');";
           
            if ($conn->query($sqli)=== TRUE){
                echo "Usuario creado correctamente";
            }
    
    
           
           $sqlu = "UPDATE `users` SET `score` = '".$score."'
                WHERE `users`.`username` = '".$username."';";
    
        }else{
            echo "Faltan datos para crear el usuario";
        }



    }






    #mysql_close($conn);