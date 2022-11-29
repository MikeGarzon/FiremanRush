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

        if (isset($_GET['username'])  && isset($_GET['password'])){

            $username = $_GET['username'];
            $password = $_GET['password'];
    
    
            $sql = "SELECT * FROM `users` WHERE username = '".$username."' AND
                                                password = '".$password."' ;";
            $result = $conn->query($sql);

            if ($result-> num_rows > 0 ){
                echo "Login exitoso";

                #Guardamos los datos
                $sql = "SELECT * FROM `users` WHERE username = '".$username."' AND
                    password = '".$password."' ;";
                $result = $conn->query($sql);

                $texto = '';

                while ($row = $result->fetch_assoc()){
                    $texto =
                    "{#username#:#".$row['username'].
                    "#,#password#:#".$row['password'].
                    "#,#score#:".$row['score'].
                    "}";
                }

                echo 'Mensaje:'.$texto.'';

            }else{
                echo "Login fallido";
            }

    
        }else{
            echo "Faltan datos para crear el usuario";
        }



    }






    #mysql_close($conn);