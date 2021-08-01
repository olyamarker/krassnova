<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// Формирование самого письма
$title = "Мессага от поклонника :3";
$body = "
<h2>С нижайшим поклоном, обращается к Вам раб Божий $name</h2>
<b>Телефончик:</b> $phone<br><br>
<b>Прошение:</b><br>$message
";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.gmail.com'; // SMTP сервера вашей почты
    $mail->Username   = 'krasnova047@gmail.com'; // Логин на почте
    $mail->Password   = 'Karep3984'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465; 
    $mail->setFrom('krasnova047@gmail.com', 'Ольга Краснова'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('krassnova47@gmail.com');  

// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;    

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
header('Location: thankyou.html');