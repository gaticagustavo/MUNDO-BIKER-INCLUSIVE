<?php
if(!empty($_POST("button"))){
    if (!empty($_POST["usuario"]) and !empty($_POST["password"])){
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];
        echo $usuario;
        echo $password;
    }else{
        echo "campo vacios";
    }
    }