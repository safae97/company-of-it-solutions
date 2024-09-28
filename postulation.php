<?php

  use PHPMailer\PHPMailer\PHPMailer;
  
  use PHPMailer\PHPMailer\Exception;



  require 'phpmailer/src/Exception.php';
  require 'phpmailer/src/PHPMailer.php';
  require 'phpmailer/src/SMTP.php';

  if(isset($_POST ["send"])){
    $mail = new PHPMailer(true) ;
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username='ayaaitsakrim@gmail.com';
    $mail->Password='aurv qajz xakq fozg';
    $mail->SMTPSecure ='ssl';
    $mail->Port = 465;

    $mail->setFrom('ayaaitsakrim@gmail.com');
    $mail->addAddress($_POST["email"]);

    $mail->isHTML(true);
         
    $mail->Subject = $_POST["Subject"];
    $mail->Body = $_POST["message"];


    if(isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
        $file_tmp_name = $_FILES['pdf']['tmp_name'];
        $file_name = $_FILES['pdf']['name'];
        $mail->addAttachment($file_tmp_name, $file_name);
    }
       

    if($mail->send()){
      echo  
      "
      <script>
      alert('Sent Successfuly');
      document.location.href = 'contact.php';
      </script>
      " ;
    }

    
  }

?>