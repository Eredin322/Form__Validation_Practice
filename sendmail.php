<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'phpmailer/src/Exception.php'
  require 'phpmailer/src/PHPMailer.php'

  $mail = new PHPMailer(true);
  $mail->CharSet = 'UTF-8';
  $mail->setLanguage('ru', 'phpmailer/language/')
  $mail->IsHTML(true);

  // От кого письмо
  $mail->setForm('info@fls.guru', 'Фрилансер по жизни')
  // Кому отправить
  $mail->addAddress('code@fls.guru');
  // Тема письма
  $mail->Subject = 'Привет! Это "Фрилансер по жизни"';

  //Рука
  $hand = "Правая";
  if($_POST['hand'] == "left"){
    $hand = "Левая";
  }

  //Тело письма
  $body = '<h1>Встречайте супер письмо!</h1>';

  if(trim(!emply($_POST['name']))){
    $body.='<p><strong>Имя:</strong></p>'.$_POST['name'].'</p>';
  }
  if(trim(!emply($_POST['email']))){
    $body.='<p><strong>Имя:</strong></p>'.$_POST['email'].'</p>';
  }
  if(trim(!emply($_POST['hand']))){
    $body.='<p><strong>Имя:</strong></p>'.$hand.'</p>';
  }
  if(trim(!emply($_POST['age']))){
    $body.='<p><strong>Имя:</strong></p>'.$_POST['age'].'</p>';
  }
  if(trim(!emply($_POST['message']))){
    $body.='<p><strong>Имя:</strong></p>'.$_POST['message'].'</p>';
  }

  //Прикрепить файл
  if (!empty($_FILES['image']['tmp_name'])) {
    //путь загрузки файла
    $filePath = __DIR__."/files/".$_FILES['image']['name'];
    //грузим файл
    if (copy($_FILES['image']['tmp_name'], $filePath)){
      $fileAttach = $filePath;
      $body.='<p><strong>Фото в приложении</strong></p>'
      $mail->addAttachment($fileAttach);
    }
  }

  $mail->Body = $body;

  if (!$mail->send()) {
    $message = 'Ошибка';
  } else {
    $message = 'Данные отправлены!';
  }

  $response = ['message' => $message];

  header('Content-type: application/json');
  echo json_encode($response);
?>