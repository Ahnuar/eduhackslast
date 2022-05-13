<?php
$session=isset($_COOKIE['PHPSESSID']);
    if(isset($_COOKIE['PHPSESSID'])){
        session_start();
        if(!isset($_SESSION['Usuari'])){
            header("Location:../index.php");
            exit();
        }else{
            require 'database.php';
            //obtenemos datos de usuario para representarlo en el main
            $nombre=getname($_SESSION['Usuari']);
            $apellido=getlastname($_SESSION['Usuari']);
            $mail=getmail($_SESSION['Usuari']);
            $creationdate=substr(getcreationDate($_SESSION['Usuari']),0,10);
        }
    }else{
        header("Location:../index.php");
        exit();
    }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="../media/image-asset.png">


    <title>Eduhacks</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <link href="../css/album.css" rel="stylesheet">
    <script src="../js/prueba.js"></script>
  </head>
    <body>
        <!-- Navigation-->
        <header>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="../index.php" class="navbar-brand d-flex align-items-center">
            <strong>Eduhacks</strong>
          </a>
          <ul class="nav justify-content-end">
            <li class="nav-item">
              <a class="nav-link" href="./challengs.php">Challenges</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./ranking.php">Ranking</a>
            </li>
            <?php
              if($session){
                  echo '<li class="nav-item">
                  <a class="nav-link" href="./profile.php">Profile</a> </li>';
                  echo '<li class="nav-item">
                  <a class="nav-link" href="./logout.php">Logout</a> </li>';
                }else{
                  echo '<li class="nav-item">
                  <a class="nav-link" href="./login.php">Login</a>';
                }
            ?>
          </ul>
        </div>
      </div>
    </header>
        <hr class="m-0" />
            <!-- Awards-->
        <section class="jumbotron text-center">
        <div class="container">
		  <table class="col-lg-11 offset-lg-1">
              <tr>
              <h1 class="jumbotron-heading"><?php echo strtoupper($nombre.' </span> '.$apellido);?></h1>
                <br><br>
              </tr>
            <tr>
                <th>Nombre de usuario:</th>
                <td><?php echo $_SESSION['Usuari'];?></td>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td><?php echo ucfirst($nombre);?></td>
            </tr>
            <tr>
                <th>Apellidos: </th>
                <td><?php echo ucfirst($apellido);?></td>
            </tr>
            <tr>
                <th>Miembro desde:</th>
                <td><?php echo $creationdate;?></td>
            </tr>
            <tr>
                <th>Correo electronico: </th>
                <td><?php echo taparTexto($mail,10,2);?></td>
            </tr>
            <tr>
                <th>Contraseña: </th>
                <td>*******</td>
            </tr>
            </table>
            <br>
            <a href="./sendResetPassword.php" class="btn btn-secondary my-2" type="button">Reset Password</a>
          <p>
            <!--<a href="./crearReto.php" class="btn btn-secondary my-2" type="button">ADD A CHALLENGE</a>-->
          </p>
        </div>
      </section>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

    <footer class="text-muted">
    <div class="footer vw-100">
    <div class="btn-group vw-100" role="group" aria-label="Basic example">
        <button type="button" onclick="location.href = '../index.php';"class="btn btn-primary vw-100"><img class="footernav" src="../assets/img/home.png" alt="Girl in a jacket"></button>
        <button type="button" onclick="location.href = './challengs.php';" class="btn btn-primary vw-100" data-bs-toggle="modal" data-bs-target="#exampleModal"><img class="footernav" src="../assets/img/signo.png" alt="Girl in a jacket"></button>
        <button type="button" onclick="location.href = './profile.php';" class="btn btn-primary vw-100"><img class="footernav" src="../assets/img/profile.png" alt="Girl in a jacket"></button>
      </div>
    </div>
    <div class="container">
      <p>Eduhacks.com © 2022</p>
    </div>
  </footer>
    </body>
</html>
