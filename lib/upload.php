<?php
    $session=isset($_COOKIE['PHPSESSID']);
    if($session && isset($_POST['Cname'])  && isset($_POST['Cdescription']) && isset($_POST['Chashtag']) && isset($_POST['Cflag'])){
        session_start();
        if(isset($_SESSION['Usuari'])){
            require 'database.php';
            //insertar el challenge
            if(isset($_FILES['fileToUpload'])){
              $nomOriginal = $_FILES["fileToUpload"]["name"];
              $ruta = "\uploads".$nomOriginal;
              insertchallenges($_POST['Cname'],$_POST['Cdescription'],$_POST['Cflag'],$nomOriginal,$ruta);
              $nomCod = hash('sha256',$_FILES["fileToUpload"]["name"]);
              $rutaCod = "../uploads/".$nomCod;
             
              move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$rutaCod);
            }else{
              insertchallenges($_POST['Cname'],$_POST['Cdescription'],$_POST['Cflag'],NULL,NULL);
            }
            //id del reto
            //insertar el hashtag del challenge
            $idreto=getidretos($_POST['Cname']);
            $array = $_POST['Chashtag'];
            $hashtagarray =  explode ( ' ', $array);
            inserthastag($hashtagarray,$idreto);
        } 
        header("Location: challengs.php");        
        exit();
    }else{
     
      header("Location: challengs.php");        
        exit();
    }