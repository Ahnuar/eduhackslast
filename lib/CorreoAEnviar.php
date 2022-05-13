<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require 'vendor/autoload.php';

    function crearCorreu(){
        $mail = new PHPMailer();
        $mail ->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = True;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        //crear un correo para llenar el username y password
        $mail->Username = '';
        $mail->Password = '';
        
        return $mail;
    }

    function enviarCorreu($mail,$destinatario,$username,$code){
        $mail->SetFrom('eduhacks.no.reply@gmail.com','Eduhacks');
        $mail->Subject = 'Activacion de usuario - Eduhacks';

        $mail->MsgHTML('
            <h1>User Activation:</h1>
            <p>Hi, '.$username.' <br />
            Este correo es para activar tu cuenta. Pincha en el siguiente link para realizar la activacion.</p>
            <button><a href="http://localhost/Eduhacks/lib/mailcheck.php?code='.$code.'&mail='.$destinatario.'">http://localhost/Eduhacks/lib/mailcheck.php?code='.$code.'&mail='.$destinatario.'</a></button>
        ');
        $address = $destinatario;
        $mail->AddAddress($address,'Activacion Usuario');
        $res = $mail->Send();
        return $res;
    }

    function enviarCorreuReset($mail,$destinatario,$code){
        $mail->SetFrom('eduhacks-No-Reply@gmail.com','Eduhcacks');
        $mail->Subject = 'Reset password  - Eduhacks';
        $mail->MsgHTML('
        <h1>Reset Password:</h1>
        <p>Hi, '.$destinatario.'
        Este correo es para restablecer tu password. Pincha en el siguiente link para restablecerla.</p>
        <form method="post" action="http://localhost/Eduhacks/lib/mailcheck.php?code='.$code.'&mail='.$destinatario.'">
            <button type="submit">Take me</button>
        </form>
        
    ');
        $address = $destinatario;
        $mail->AddAddress($address,'Restablecer contraseña');
        $res = $mail->Send();
        return $res;    
    }