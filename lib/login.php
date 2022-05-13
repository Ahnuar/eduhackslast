
<?php 
    
    if(isset($_COOKIE['PHPSESSID'])){
      //Si tenemos una session abierta
      header("Location: challengs.php");
      exit();
   }else if(isset($_POST['user']) && isset($_POST['apellido'])){
      require('controlUsuaris.php');
      //si viene desde el register para registar el usuarios
      afegirUsuari($_POST);
    }else if(isset($_POST['user']) && !isset($_POST['apellido'] )){
      require('controlUsuaris.php');
      //Si viene de el login y verificar el usuario
      verificaUsuari($_POST);
    }



    //reset de password
    if(isset($_POST['email-reset'])){
      require './database.php';
      require './CorreoAEnviar.php';
      $existe=ComprobarMail($_POST['email-reset']);
        if($existe){
            $code=password_hash(rand(),PASSWORD_DEFAULT);
            $mail=crearCorreu();
            insertcode($code,$_POST['email-reset']);
            enviarCorreuReset($mail,$_POST['email-reset'],$code);
            header("Location: ./login.php");
            exit();
        } else{
          echo '<script language="javascript">';
          echo 'alert("Este mail no existe")';
          echo '</script>'; 
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
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" type="image/png" href="../media/image-asset.png">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
  </head>
  <body>
    <div class="parent clearfix">
      <div class="bg-illustration" >
    </div> 
      <div class="login">
        <div class="container">
          <h1>Login</h1>
          
          <div class="login-form">
          <?php
            if(isset($_GET['redirected'])){
              echo '<div class="alert alert-secondary" role="alert">';
              echo 'You must be logged in';
              echo '</div>';
            }

            if(isset($_GET['inactive'])){
              echo '<div class="alert alert-secondary" role="alert">';
              echo 'Your account is inactive';
              echo '</div>';
            }
            if(isset($_GET['badpasswordoruser'])){
              echo '<div class="alert alert-secondary" role="alert">';
              echo 'Bad Username or password';
              echo '</div>';
            }

            if(isset($_GET['registrado'])){
              echo '<div class="alert alert-secondary" role="alert">';
              echo 'User created correctly';
              echo '</div>';
            }
            if(isset($_GET['badpassword'])){
              echo '<div class="alert alert-secondary" role="alert">';
              echo 'The passwords dont match';
              echo '</div>';
            }
            if(isset($_GET['BadUseroMail'])){
              echo '<div class="alert alert-secondary" role="alert">';
              echo 'User or mail already exist';
              echo '</div>';
            }
            if(isset($_GET['userActivated'])){
              echo '<div class="alert alert-secondary" role="alert">';
              echo 'User activated correctly';
              echo '</div>';
            }
            if(isset($_GET['internalerror'])){
              echo '<div class="alert alert-secondary" role="alert">';
              echo 'Internal error';
              echo '</div>';
            }
            if(isset($_GET['resetsuccess'])){
              echo '<div class="alert alert-secondary" role="alert">';
              echo 'Password reset correctly';
              echo '</div>';
            }
          ?>
            <form action="login.php" method="POST">
              <input type="username" placeholder="Username" name="user">
              <input type="password" placeholder="Password" name="password">        
              <button type="submit">LOG-IN</button>
            </form>
              <!-- Button trigger modal -->
              <div class="forget-pass">
                <a type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Forgot Password
                </a>
              </div>  <!-- Modal -->
                  <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                      <div class="modal-body">
                        <form action="./login.php" method="POST">
                          <input type="email" placeholder="Email" name="email-reset" required>
                          <input type="submit" value="Reset Password">
                        </form>
                      </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>




    
  
            <div class="forget-pass">
      <a type="button"  data-bs-toggle="modal" data-bs-target="#example2">
        Register
      </a>
      </div>


      <div class="modal fade" id="example2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">REGISTER</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="./login.php" class="signup" method="POST">
                  <div class="field">
                    <input id="user" name="user" type="text" placeholder="Username" required>
                  </div>
                  <div class="field">
                    <input id="nombre" name="nombre" type="text" placeholder="Nombre" required>
                  </div >
                  <div class="field">
                    <input id="apellido" name="apellido" type="text" placeholder="Apellido" required>
                  </div>
                  <div class="field">
                    <input id="Email" name="Email" type="text" placeholder="Email Address" required>
                  </div>
                  <div class="field">
                    <input id="password" name="pass1" type="password" placeholder="Password" required>
                  </div>
                  <div class="field">
                    <input type="password"  name="pass2" placeholder="Confirm password" required>
                  </div>
                  <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" value="Signup">
                  </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
      </div>
      </div>

      </div>
        </div>
    </div>  
    
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


      <script src="./js/scripts.js"></script>
      
</body>





</html>