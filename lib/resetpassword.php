
<?php 
    
    if(isset($_GET['email']) && isset($_GET['code'])){
      require 'database.php';
      $mailcode=getcodeuser($_GET["email"]);
      if($mailcode!=$_GET["code"]){
             header("Location: ../login.php?internalerror");
             exit();             
      }
    }else{
      require 'database.php';
      $mailcode=getcodeuser($_POST["email"]);
      if(isset($_POST['pwd-2']) && isset($_POST['pwd-1'])){
             if($_POST['pwd-2']==$_POST['pwd-1']){
                    if($mailcode==$_POST["code"]){
                           $updatepassword=updatePassword($_POST["email"],$_POST['pwd-1']); 
                           //Crear alerta que se ha ejecutado
                          header("Location: ./login.php?resetsuccess");
                          exit();
                    }             
             }else{
                    //Create alert que las contraseñas no coindicen
                    header("Location: ./login.php?badpassword");
                    exit();
             }
      }else{  
        header("Location: ./login.php?internalerror");
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
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" type="image/png" href="../media/image-asset.png">

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
            <form action="resetpassword.php" method="POST">
              <input id="email" name="email" type="hidden" value="<?php echo $_GET["email"] ?>">
              <input id="codez" name="code" type="hidden" value="<?php echo $_GET['code'] ?>">
              <input id="pwd-2" name="pwd-1" type="password" placeholder="Nueva contraseña" required>
              <input id="pwd-2" name="pwd-2" type="password" placeholder="Repita la contraseña" required>
              <button type="submit">RESET PASSWORD</button>
            </form>
          </div>
        </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="./js/scripts.js"></script>
  </body>





</html>