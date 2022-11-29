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
                $sql = "SELECT * FROM `users` WHERE username = '".$username."' AND
                    password = '".$password."' ;";
                $result = $conn->query($sql);

                $texto = '';

                while ($row = $result->fetch_assoc()){
                    $texto =
                    "{#username#:".$row['username'].
                    ",#password#:#".$row['password'].
                    "#,#score#:#".$row['score'].
                    "}";
                }

                echo 'Mensaje:'.$texto.'';
            }
    

    
           
           $sqlu = "UPDATE `users` SET `score` = '".$score."'
                WHERE `users`.`username` = '".$username."';";
    
        }else{
            echo "Faltan datos para crear el usuario";
        }



    }






    #mysql_close($conn);