<?php
    require 'CorreoAEnviar.php';
    require 'database.php';
    //verificacion de usuarios

    function verificaUsuari($post){
        //comprobacion si el usuario existe y si la contrasena con el usuario existe
        if(ComprobarUsuarios($post['user']) && ComprobarPassword($post['user'],$post['password'])){
            //comprobacion si el usuario esta activo
            if(UsuarioActiu($post['user'])){    
                LastSignIn($post['user']);
                session_start();
                $_SESSION['Usuari']=$post['user'];
                header("Location: challengs.php");
                exit;
            }else{
                header("Location: login.php?inactive");
                exit;
            }
            
        }else{
            header("Location: login.php?badpasswordoruser");
            exit;
          
        }
    }
    //anadir un usuario a la base de datos
    function afegirUsuari($post){  
        $db=databaseConnection();
        //comprobamos que el usuario y el mail no esten registrados
        if(!ComprobarUsuarios($post['user']) && !ComprobarMail($post['Email'])){
            //comprobamos que la contra este correctamente 
            if($post['pass1']==$post['pass2']){
                //Insertar el usuario
                
                $code= password_hash(rand(),PASSWORD_DEFAULT);
                $alertInsertUser=insertUser($post['user'],$post['Email'],$post["pass1"],$post['nombre'],$post['apellido'],$code);
                insertcurrenttime($post['Email']);
                //PARTE DE MAIL:
                $mail=crearCorreu();
                $enviado=enviarCorreu($mail,$post['Email'],$post['user'],$code);

                if($alertInsertUser){
                    header("Location: login.php?registrado");
                    exit;
                }
            }else{
                header("Location: login.php?badpasswordR");
                exit;
            }
        }else{
            header("Location: login.php?BadUseroMail");
            exit;
        }
    }

   