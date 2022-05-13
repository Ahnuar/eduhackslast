<?php
    $session=isset($_COOKIE['PHPSESSID']);
    if($session){
        session_start();
        if(isset($_SESSION['Usuari'])){
            require 'database.php';
            //obtenemos datos de usuario para representarlo en el main
            $nombre=strtoupper(getname($_SESSION['Usuari']));
            $apellido=strtoupper(getlastname($_SESSION['Usuari']));
            $mail=getmail($_SESSION['Usuari']);
            $id=getuserid($mail);
        }
    }else{
     
      header("Location: login.php?redirected");        
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

    <main class="main" role="main">

        <div class="container challenges">
          <a class="btn btn-secondary my-2" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">ADD A CHALLENGE</a>
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">ADD A CHALLENGE</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form action="upload.php" method="post" enctype="multipart/form-data">
                              <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Title Of The Challenge</label>
                                <input type="text" class="form-control" id="ChallengeName" name="Cname" placeholder="Title Of The Challenge" required>
                              </div>
                              <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Description</label>
                                <input type="text" class="form-control" id="ChallengeDescription" name="Cdescription" placeholder="Description" required>
                              </div>
                                <div class="mb-3">
                                   <label for="formGroupExampleInput" class="form-label">Hashtag</label>
                                    <input type="text" class="form-control" id="ChallengeHashtag" name="Chashtag" placeholder="Hashtag" required>
                                </div>
                              <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Flag</label>
                                <input type="text" class="form-control" id="ChallengeFlag" name="Cflag" placeholder="Flag" required>
                              </div>
                              <div class="mb-3">
                                <label for="formFile"  class="form-label">Upload a file</label>
                                <input class="form-control" name="fileToUpload" type="file" id="fileToUpload">
                              </div>
                            <button type="submit" class="btn btn-primary">Upload Challenge</button>
                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
          </div>                
  
        </div> 

      <div class="album py-5 bg-light">
        <div class="container">
        <div class="row">
          <h3>Your Challenges</h3>
          <br>
          <?php 
            $retos=getuserchallenges($mail);
            $tenemosreto=$retos->rowcount()>0 ? true : false;
            if($tenemosreto){
              foreach($retos as $reto){
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
                  echo    '<h6>Creation Date</h6>';
                  echo     '<p class="card-text">'.$reto[4].'</p>';
                  echo     '<h6>Additional Resources</h6>';
                  if($reto[5]!=null){
                    echo     '<p><a href="../uploads/'.hash('sha256',$reto[5]).'" download="'.$reto[5].'">'.$reto[5].'</a></p>';
                  }else{
                    echo     '<p>No additional resources</p>';
                  }
                 
                  echo     '<h6>Flag</h6>';  
                  echo     '<i><p class="flag">'.$reto[2].'</p></i>';    
                  echo    '<div class="d-flex justify-content-between align-items-center">';
                  echo     '<div class="btn-group">';
                  echo     '<button type="button" class="btn btn-sm btn-outline-secondary">Completed</button>';
                  echo     '</div>';
                  echo     '<small class="text-muted">+10 puntos</small>';
                  echo     '</div>';
                  echo     '</div>';
                  echo     '</div>';
                  echo     '</div>';
              }
            }else{
              echo '<h3>You don\'t have any challenges yet</h3>';
            }
          ?>
          
          </div>
        </div>
      </div>
      <div class="album py-5 bg-light"> 

      <div class="container">
      <a class="btn btn-secondary my-2" type="button"  data-bs-toggle="modal" data-bs-target="#modalfilter">FILTER</a>
      <a class="btn btn-secondary my-2" type="button" href="challengs.php">RESET</a>

      <div class="modal fade" id="modalfilter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">FILTER BY CATEGORY</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form action="./challengs.php" method="post" enctype="multipart/form-data">
                          <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Hashtag</label>
                            <input type="text" class="form-control" id="ChallengeHashtag" name="category" placeholder="Categoria" required>
                          </div>
                            <button type="submit" class="btn btn-primary">FILTER</button>
                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
          </div>
          <h3>Challenges</h3>
          <br>
          <div class="row">
            <?php
              $retosgenerales=getretos();
              $tenemosreto=$retosgenerales->rowcount()>0 ? true : false;
              if(!isset($_POST['category'])){
                if($tenemosreto){
                  foreach($retosgenerales as $reto){
                    $categorias=getcategories($reto[3]);
                    $tieneretos=getcompletadobyid($reto[3]);
                    $verifychallenge=$tieneretos->rowcount()>0 ? true : false;
                    if($reto[2]!=$id){
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
                      echo    '<h6>Owner</h6>';
                      echo     '<p class="card-text">'.$reto[4].'</p>';
                      echo    '<h6>Creation Date</h6>';
                      echo     '<p class="card-text">'.$reto[5].'</p>';
                      echo     '<h6>Additional Resources</h6>';
                      if($reto[6]!=null){
                        echo     '<p><a href="../uploads/'.hash('sha256',$reto[6]).'" download="'.$reto[6].'">'.$reto[6].'</a></p>';
                      }else{
                        echo     '<p>No additional resources</p>';
                      }
                      echo     '<h6>Flag</h6>';

                      if(!$verifychallenge){
                      echo     '<form action="./verifychallenge.php" method="POST">';
                      echo     '<div class="mb-3">';  
                      echo     '<input name="cflag" type="text" class="form-control" id="flag">';  
                      echo     '<input type="hidden" name="cid" value='.$reto[3].'>';     
                      echo     '<button type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>';  

                      echo     '</form>';
                      echo     '</div>'; 
                    }else{
                      echo     '<i><p class="flag">completed</p></i>';
                    }   

              
                      echo     '<small class="text-muted">+10 puntos</small>';
                      echo     '</div>';
                      echo     '</div>';
                      echo     '</div>';
                    }
                  }
                }else{
                  echo '<h3>There is no challenge yet</h3>';
                }
              } else{
                if(getexistecategoria($_POST['category'])){
                  $retosfiltrados=getretosfiltrados($_POST['category']);
                  foreach($retosfiltrados as $reto){
                    $tieneretos=getcompletadobyid($reto[3]);
                    $verifychallenge=$tieneretos->rowcount()>0 ? true : false;
                    
                      echo    '<div class="col-md-4">';
                      echo    '<div class="card mb-4 box-shadow">';
                      echo    '<div class="card-body">';
                      echo    '<h5>'.$reto[0].'</h5>';
                      echo    '<h6>Hashtag</h6>';
                      echo     $_POST['category'];
                      echo    '<h6>Description</h6>';
                      echo     '<p class="card-text">'.$reto[1].'</p>';
                      echo    '<h6>Owner</h6>';
                      echo     '<p class="card-text">'.$reto[4].'</p>';
                      echo    '<h6>Creation Date</h6>';
                      echo     '<p class="card-text">'.$reto[5].'</p>';
                      echo     '<h6>Additional Resources</h6>';
                      echo     '<p>PDF RANDOM</p>';
                      echo     '<h6>Flag</h6>';

                      if(!$verifychallenge && $reto[2]!=$id){
                      echo     '<form action="./verifychallenge.php" method="POST">';
                      echo     '<div class="mb-3">';  
                      echo     '<input name="cflag" type="text" class="form-control" id="flag">';  
                      echo     '<input type="hidden" name="cid" value='.$reto[3].'>';     
                      echo     '<button type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>';  

                      echo     '</form>';
                      echo     '</div>'; 
                    }else{
                      echo     '<i><p class="flag">completed</p></i>';
                    }   
                      echo     '</div>';
                      echo     '</div>';
                      echo     '</div>';
                  }
                }else{
                  echo '<h3>No existe la categoria "'.$_POST['category'].'"!</h3>';
                }
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
        <button type="button" onclick="location.href = '../index.php';"class="btn btn-primary vw-100"><img class="footernav" src="../assets/img/home.png" alt="Girl in a jacket"></button>
        <button type="button" class="btn btn-primary vw-100" data-bs-toggle="modal" data-bs-target="#exampleModal"><img class="footernav" src="../assets/img/signo.png" alt="Girl in a jacket"></button>
        <button type="button" onclick="location.href = './profile.php';" class="btn btn-primary vw-100"><img class="footernav" src="../assets/img/profile.png" alt="Girl in a jacket"></button>
      </div>
    </div>
    <div class="container">
      <p>Eduhacks.com © 2022</p>
    </div>
  </footer>

    
    
</html>