<?php
        if(isset($_GET['mail']) && isset($_GET['code']) ){
            require 'database.php';
            //obtenemos el codigo del user
            $mailcode=getcodeuser($_GET["mail"]);
            if($mailcode == $_GET["code"]){
                //hacemos el update para activarlo
                $activo=updateActiveUser($_GET["mail"]);
                //alerts
                if($activo){
                    header("Location: ./login.php?userActivated");
                    exit();
                }else{
                    header("Location: ./login.php?internalerror");
                    exit();
                }
            }else{    
                header("Location: ./login.php?internalerror");
                exit();
            } 

        }else{
            header("Location: ./login.php?internalerror");
            exit();

        }
