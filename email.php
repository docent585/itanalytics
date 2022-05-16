<?php

$to =  getenv('SEND_MAIL_TO'); // Добавить в файле php-fpm.conf, в раздел [www] 'env[SEND_MAIL_TO] = <email>' и перезапустить службу fpm
$subject = "Тема сообщения"; //Тема сообщения
$message = "Message, сообщение!"; //Сообщение, письмо
$headers = "From: noreply@itanalytics.kz \r\n" . "Content-type: text/html; charset=utf-8 \r\n"; //Шапка сообщения, содержит определение типа письма, от кого, и кому отправить ответ на письмо
$question = 'Потенциальный клиент не написал сообщение )))';

// Проверяем или метод запроса POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Поочередно проверяем или были переданные параметры формы, или они не пустые
    if (isset($_POST["username"])) {
            //Если параметр есть, присваеваем ему переданое значение
            $name = trim(strip_tags($_POST["username"]));
        }
        if (isset($_POST["usernumber"])) {
            $number = trim(strip_tags($_POST["usernumber"]));
        }
        if (isset($_POST["question"])) {
                $question = trim(strip_tags($_POST["question"]));
                if (empty($question)) {
                        $question = 'Потенциальный клиент не задал вопрос )))';
                }
        }
        // Формируем письмо
        $message = "<html>";
        $message .= "<body>";
        $message .= "Телефон: ".$number;
        $message .= "<br />";
        $message .= "Имя: ".$name;
        $message .= "<br />";
        $message .= "Вопрос: ".$question;
        $message .= "</body>";
        $message .= "</html>";
        // Окончание формирования тела письма
        // Посылаем письмо
        mail($to, $subject, $message, $headers);
        // Редирект на домашнюю страницу
        header("Location: https://itanalytics.kz/");
        die();
    }
    else {
        exit;
  }

?>