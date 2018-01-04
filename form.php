<?php
    $msg_box = ""; // в этой переменной будем хранить сообщения формы
    $errors = array(); // контейнер для ошибок
    // проверяем корректность полей
 
    // если форма без ошибок
    if(empty($errors)){     
        // собираем данные из формы
        $message  = "Имя : " . $_POST['user_name'] . "<br/>";
        $message .= "Телефон: " . $_POST['user_phone'] . "<br/>";
        $message .= "Email: " . $_POST['user_email'] . "<br/>";
        $message .= "Программа: " . $_POST['user_select'] . "<br/>";
        send_mail($message); // отправим письмо
        // выведем сообщение об успехе
        $msg_box = "<span style='color: green;font-weight:bold;'>Спасибо. Наш менеджер свяжется с Вами в ближайшее время!</span>";
    } else {
        // если были ошибки, то выводим их
        $msg_box = "";
        foreach($errors as $one_error){
            $msg_box .= "<span style='color: red;font-weight:bold;'>Фнкция mail не отработала!</span><br/>";
        }
    }
 
    // делаем ответ на клиентскую часть в формате JSON
    echo json_encode(array(
        'result' => $msg_box
    ));
     
     
    // функция отправки письма
    function send_mail($message){
        // почта, на которую придет письмо
        $mail_toFirst = "youremail@gmail.com"; 
        //$mail_toSecond = "youremail@gmail.comm"; 
        // тема письма
        $subject = "Заявка на обучение";
         
        // заголовок письма
        $headers= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
        $headers .= "From: Заказ звонка <info@edavoffice.kz>\r\n"; // от кого письмо
         
        // отправляем письмо 
        mail($mail_toFirst, $subject, $message, $headers);
       // mail($mail_toSecond, $subject, $message, $headers);
    }
     
?>
