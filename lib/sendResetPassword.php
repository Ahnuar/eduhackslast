<?php
    require './database.php';
    require './CorreoAEnviar.php';
    session_start();

    $code=password_hash(rand(),PASSWORD_DEFAULT);
    insertcode($code,getmail($_SESSION['Usuari']));
    $mail=crearCorreu();
    $destinatario=getmail($_SESSION['Usuari']);
    enviarCorreuReset($mail,$destinatario,$code);
    header('Location: ./profile.php');

