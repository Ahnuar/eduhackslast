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

    <main role="main">

      <section class="jumbotron text-center">
      <div class="container">
			<h1 class="jumbotron-heading">Ranking de usuarios</h1><br>
  				<div class="container col-12">
			<?php 
				$res = getRanking();
				$pos = 1;
				echo '<table class="table col-12">
        <br>
				<tr class="col-12">
				<th class="col-4">
					Posicion
				</th>
				<th class="col-4">
					Usuario
				</th>
				<th class="col-4">
					Puntuacion<br>
				</th>
				</tr>';
				foreach($res as $registro){
					echo '
					<tr class="col-12">
					<th class="col-4">
						'.$pos.'
					</th>
					<td class="col-4">
						'.$registro['usuario'].'
					</td>
					<td class="col-4">
						'.$registro['puntostotal'].'
					</td>
					</tr>
					';
					$pos = $pos+1;
				}
				echo '</table>';
			?>
			</div>
			<div class="container col-3"></div>
		</section>
    <section class="jumbotron text-center">
      <div class="container">
			<h1 class="jumbotron-heading">Retos mas completados</h1><br>
  				<div class="container col-12">
        <?php 
            $res = getrankingretos();
            $pos = 1;
            echo '<table class="table col-12">
            <br>
            <tr class="col-12">
            <th class="col-4">
              Posicion
            </th>
            <th class="col-4">
              Reto
            </th>
            <th class="col-4">
              Veces Completado<br>
            </th>
            </tr>';
            foreach($res as $registro){
              echo '
              <tr class="col-12">
              <th class="col-4">
                '.$pos.'
              </th>
              <td class="col-4">
                '.$registro[0].'
              </td>
              <td class="col-4">
                '.$registro[1].'
              </td>
              </tr>
              ';
              $pos = $pos+1;
            }
            echo '</table>';
          ?>
      </div>
    </section>
		      
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
  <footer class="text-muted">
    <div class="footer vw-100">
    <div class="btn-group vw-100" role="group" aria-label="Basic example">
        <button type="button" onclick="location.href = '../index.php';"class="btn btn-primary vw-100"><img class="footernav" src="../assets/img/home.png" alt="Girl in a jacket"></button>
        <button type="button" onclick="location.href = './challengs.php';" class="btn btn-primary vw-100" data-bs-toggle="modal" data-bs-target="#exampleModal"><img class="footernav" src="../assets/img/signo.png" alt="Girl in a jacket"></button>
        <button type="button" onclick="location.href = './profile.php';" class="btn btn-primary vw-100"><img class="footernav" src="../assets/img/profile.png" alt="Girl in a jacket"></button>
      </div>
    </div>
    <div class="container">
      <p>Eduhacks.com ?? 2022</p>
    </div>
  </footer>
    
</html>