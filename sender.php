<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $subject = "Новая бронь!";
    $message = "Услуга: {$_POST['usl']}<br/>";
    $message .= "Телефон: {$_POST['tel']}<br/>";
    $message .= "Дата: {$_POST['date']}<br/>";
    $message .= "Время: {$_POST['time']}<br/>";
    $message .= "Номер машины: {$_POST['auto_number']}<br/>";
    if($_POST['message']){
        $message .= "Сообщение: {$_POST['message']}<br/>";
    }
    $to="chalovmirror@gmail.com, Continent-marina@mail.ru";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    mail ($to, $subject, $message, $headers);
	echo "Заявка принята!";
}
?>