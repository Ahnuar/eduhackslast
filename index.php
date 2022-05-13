<?php
    $session=isset($_COOKIE['PHPSESSID']);
    if($session){
        session_start();
        if(isset($_SESSION['Usuari'])){
            require './lib/database.php';
            //obtenemos datos de usuario para representarlo en el main
            $nombre=strtoupper(getname($_SESSION['Usuari']));
            $apellido=strtoupper(getlastname($_SESSION['Usuari']));
            $mail=getmail($_SESSION['Usuari']);
            $id=getuserid($mail);
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="./media/image-asset.png">

    <title>Eduhacks</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <link href="./css/album.css" rel="stylesheet">
    <script src="./js/prueba.js"></script>
  </head>

  <body>

    <header>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="./index.php" class="navbar-brand d-flex align-items-center">
            <strong>Eduhacks</strong>
          </a>
        

        <ul class="nav justify-content-end">
          
          <li class="nav-item">
            <a class="nav-link" href="./lib/challengs.php">Challenges</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./lib/ranking.php">Ranking</a>
          </li>
          <?php
            if($session){
                echo '<li class="nav-item">
                <a class="nav-link" href="./lib/profile.php">Profile</a> </li>';
                echo '<li class="nav-item">
                <a class="nav-link" href="./lib/logout.php">Logout</a> </li>';
              }else{
                echo '<li class="nav-item">
                <a class="nav-link" href="./lib/login.php">Login</a>';
              }
          ?>
        </ul>
        </div>
      </div>
    </header>

    <main role="main">

      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">WELCOME TO EDUHACKS</h1>
          <p class="lead text-muted">Eduhacks is an online platform where you can upload your own CTF or complete the CTF's of the community. You can upload content for complete beginners and seasoned hackers.</p>
          <p>
            <a href="./lib/challengs.php" class="btn btn-secondary my-2" type="button">ADD A CHALLENGE</a>             
          </p>
        </div>
      </section>

      <div class="album py-5 bg-light">
        <div class="container">
          <h3>Challenges</h3>
          <br>
          <div class="row">
            <?php
              if(!$session){
                require './lib/database.php';
              }
              $retosgenerales=getretos();
              $tenemosreto=$retosgenerales->rowcount()>0 ? true : false;

              if($tenemosreto){
                foreach($retosgenerales as $reto){
                    $categorias=getcategories($reto[3]);
                    echo    '<div class="col-md-4">';
                    echo    '<div class="card mb-4 box-shadow">';
                    echo    '<div class="card-body">';
                    echo    '<h5>'.ucfirst($reto[0]).'</h5>';
                    echo '<h6>Hashtag</h6>';
                    foreach($categorias as $categoria){
                        echo $categoria[0];
                    }
                    echo    '<h6>Description</h6>';
                    echo     '<p class="card-text">'.$reto[1].'</p>';
                    echo     '<h6>Additional Resources</h6>';
                    if($reto[6]!=null){
                      echo     '<p><a href="./uploads/'.hash('sha256',$reto[6]).'" download="'.$reto[6].'">'.$reto[6].'</a></p>';
                    }else{
                      echo     '<p>No additional resources</p>';
                    }
                    echo     '<h6>Flag</h6>';  
                    echo     '<i><p class="flag">Go to challenges start the CTF</p></i>';    
                    echo    '<div class="d-flex justify-content-between align-items-center">';
                    echo     '<div class="btn-group">';
                    echo     '<button onclick="location.href = \'./lib/challengs.php\';" type="button" class="btn btn-sm btn-outline-secondary"   >Take Me</button>';
                    //echo     '<button type="button" class="btn btn-sm btn-outline-secondary">View</button>';
                    echo     '</div>';
                    echo     '<small class="text-muted">+10 puntos</small>';
                    echo     '</div>';
                    echo     '</div>';
                    echo     '</div>';
                    echo     '</div>';
                }
              }else{
                echo '<h3>There is no challenge yet</h3>';
              }
            ?>
          </div>
        </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
  <footer class="text-muted">
    <div class="footer vw-100">
    <div class="btn-group vw-100" role="group" aria-label="Basic example">
        <button type="button" onclick="location.href = './index.php';"class="btn btn-primary vw-100"><img class="footernav" src="../assets/img/home.png" alt="Girl in a jacket"></button>
        <button type="button" onclick="location.href = './lib/challengs.php';" class="btn btn-primary vw-100" data-bs-toggle="modal" data-bs-target="#exampleModal"><img class="footernav" src="../assets/img/signo.png" alt="Girl in a jacket"></button>
        <button type="button" onclick="location.href = './lib/profile.php';" class="btn btn-primary vw-100"><img class="footernav" src="../assets/img/profile.png" alt="Girl in a jacket"></button>
      </div>
    </div>
    <div class="container">
      <p>Eduhacks.com © 2022</p>
    </div>
  </footer>

    
    
</html>