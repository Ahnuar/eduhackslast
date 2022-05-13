<?php
    if(isset($_POST['email-reset'])){
      require 'database.php';
      require 'CorreoAEnviar.php';
      $existe=ComprobarMail($_POST['email-reset']);
        if($existe){
            $code=password_hash(rand(),PASSWORD_DEFAULT);
            insertcode($code,$mail);
            $mail=crearCorreu();
            enviarCorreuReset($mail,$_POST['email-reset'],$code);
            header("Location:../index.php");
            exit();
        }
    }


?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Eduhacks</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/index.css">
    </head>
    <body>
       <canvas id="c"></canvas>
        
       <div class="wrapper">
            
              <div class="title-text">
              
              <div class="title login">Reset Password</div>
              </div> 
       <div class="form-inner">
                <form action="r.php" class="login" method="POST">

                  <div class="field">
                    <input id="email-reset" name="email-reset" type="text" placeholder="Correo" required>
                  </div>
                  <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Submit">
                  </div>
                </form>
       </div>
       </div>
       <script src="./js /index.js" async defer></script>
    </body>
</html>

